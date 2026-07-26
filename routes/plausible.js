import express from 'express'
import fetch from 'node-fetch'

const router = express.Router()

router.post('/query', async (req, res) => {
  try {
    const key = process.env.PLAUSIBLE_API_KEY // ← kreiraj "Stats API" key u Plausible
    if (!key) return res.status(500).json({ error: 'Missing PLAUSIBLE_API_KEY' })

    const q = req.body // prosleđujemo šta front traži (site_id, metrics, date_range, dimensions, filters...)
    const r = await fetch('https://plausible.io/api/v2/query', {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${key}`,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(q)
    })
    const data = await r.json()
    res.status(r.status).json(data)
  } catch (e) {
    console.error('Plausible proxy error:', e)
    res.status(500).json({ error: 'Proxy error' })
  }
})

export default router
