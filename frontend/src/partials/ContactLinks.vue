<template>
  <section class="bg-slate-900 py-16">
    <div class="max-w-4xl mx-auto px-4 text-slate-300">
      <h3 class="text-2xl font-bold text-white mb-6">{{ $t('contact.links.title') }}</h3>
      <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <li><a class="hover:text-white underline" href="#">{{ $t('contact.links.regulations') }}</a></li>
        <li><a class="hover:text-white underline" href="#">{{ $t('contact.links.advertising_law') }}</a></li>
        <li><a class="hover:text-white underline" href="#">{{ $t('contact.links.ecommerce_law') }}</a></li>
        <li><a class="hover:text-white underline" href="#">{{ $t('contact.links.tax_policy') }}</a></li>
        <li><a class="hover:text-white underline" href="#">{{ $t('contact.links.education') }}</a></li>
        <li><a class="hover:text-white underline" href="#">{{ $t('contact.links.web_history') }}</a></li>
        <li><a class="hover:text-white underline" href="#">{{ $t('contact.links.ai_history') }}</a></li>
      </ul>
    </div>
  </section>
</template>

<script>
export default {
  name: 'ContactLinks',
}
</script>