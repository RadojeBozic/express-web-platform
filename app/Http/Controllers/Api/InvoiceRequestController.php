<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\Models\InvoiceRequest;


class InvoiceRequestController extends Controller

{

    /**

     * POST /api/invoice-request

     * Javno kreiranje profakture iz stavki (cene u EUR centima).

     */

    public function store(Request $request)

    {

        $validated = $request->validate([

            'name'                    => 'required|string|max:255',

            'email'                   => 'required|email',

            'currency'                => 'required|in:rsd,eur',

            'items'                   => 'required|array|min:1',

            'items.*.name'            => 'required|string|max:255',

            'items.*.qty'             => 'required|integer|min:1',

            'items.*.unit_price_cents'=> 'required|integer|min:0',

            'description'             => 'nullable|string|max:1000',

        ]);


        // Obračun ukupno u EUR centima

        $totalCents = 0;

        foreach ($validated['items'] as $it) {

            $totalCents += ((int) $it['qty']) * ((int) $it['unit_price_cents']);

        }


        $invoice = InvoiceRequest::create([

            'name'        => $validated['name'],

            'email'       => $validated['email'],

            'currency'    => strtolower($validated['currency']), // 'eur' | 'rsd' (display)

            'items'       => $validated['items'],

            'description' => $request->description,

            // legacy polje 'amount' držimo usklađeno sa total_cents radi kompatibilnosti

            'amount'      => $totalCents,

            'total_cents' => $totalCents,

            'status'      => 'pending',

        ]);


        // Generiši PDF (ako već postoji, preskoči — vidi model)

        $invoice->generatePDF();


        return response()->json([

            'message' => 'Zahtev za profakturu je uspešno sačuvan.',

            'invoice' => $invoice,

        ], 201);

    }


    /**

     * GET /api/invoice-request/{id}/pdf

     * Javno — inline prikaz PDF-a u browseru (ne download).

     */

    public function download($id)

    {

        $invoice = InvoiceRequest::findOrFail($id);


        // Kreiraj PDF ako ne postoji (ili uvek svježe, po potrebi)

        $invoice->generatePDF();


        $path = "invoices/invoice-{$invoice->id}.pdf";

        if (!Storage::exists($path)) {

            return response()->json(['error' => 'PDF nije pronađen.'], 404);

        }


        $filename = "profaktura-{$invoice->id}.pdf";

        $content  = Storage::get($path);


        return response($content, 200)

            ->header('Content-Type', 'application/pdf')

            ->header('Content-Disposition', 'inline; filename="'.$filename.'"');

    }


    /**

     * GET /api/my-invoices

     * auth:sanctum — profakture prijavljenog korisnika (po email-u).

     */

    public function userInvoices(Request $request)

    {

        $user = $request->user();

        if (!$user) {

            return response()->json(['error' => 'Unauthenticated'], 401);

        }


        return InvoiceRequest::where('email', $user->email)

            ->latest()

            ->get();

    }


    /**

     * GET /api/admin/invoices

     * auth:sanctum + admin — sve profakture.

     */

    public function allInvoices(Request $request)

    {

        $user = $request->user();

        if (!$user || !in_array($user->role ?? '', ['admin', 'superadmin'], true)) {

            return response()->json(['error' => 'Unauthorized'], 403);

        }


        return InvoiceRequest::latest()->get();

        // Ili: return InvoiceRequest::latest()->paginate(25);

    }


    /**

     * PUT /api/invoice-request/{id}/status

     * auth:sanctum + admin — promena statusa i opcioni regen PDF-a.

     */

    public function updateStatus(Request $request, $id)

    {

        $request->validate([

            'status' => 'required|in:pending,approved,paid,cancelled',

        ]);


        $user = $request->user();

        if (!$user || !in_array($user->role ?? '', ['admin', 'superadmin'], true)) {

            return response()->json(['error' => 'Unauthorized'], 403);

        }


        $invoice = InvoiceRequest::findOrFail($id);

        $invoice->status = $request->status;

        $invoice->save();


        // Po želji osveži PDF sa novim statusom

        $invoice->generatePDF(true);


        return response()->json(['message' => 'Status uspešno ažuriran.']);

    }


    /**

     * DELETE /api/invoice-request/{id}

     * auth:sanctum — brisanje sopstvene profakture ili admin.

     */

    public function destroy(Request $request, $id)

    {

        $invoice = InvoiceRequest::findOrFail($id);


        $user = $request->user();

        $isOwner = $user && $user->email === $invoice->email;

        $isAdmin = $user && in_array($user->role ?? '', ['admin', 'superadmin'], true);


        if (!$isOwner && !$isAdmin) {

            return response()->json(['error' => 'Unauthorized'], 403);

        }


        // Obriši PDF ako postoji

        $file = "invoices/invoice-{$invoice->id}.pdf";

        if (Storage::exists($file)) {

            Storage::delete($file);

        }


        $invoice->delete();


        return response()->json(['message' => 'Zahtev za profakturu je uspešno obrisan.']);

    }

}
