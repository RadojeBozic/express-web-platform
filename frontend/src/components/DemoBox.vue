<template>
  <div class="bg-slate-800 rounded-lg shadow-md p-6 flex flex-col justify-between h-full">
    <div>
      <h2 class="text-xl font-bold mb-2 text-white">{{ title }}</h2>
      <p class="text-slate-400 text-sm mb-4">{{ description }}</p>
    </div>

    <!-- Dinamički biramo tag: router-link (SPA rute) ili a (Blade/eksterni linkovi) -->
    <component
      :is="componentTag"
      :to="componentTag === 'router-link' ? safeLink : null"
      :href="componentTag === 'a' ? safeLink : null"
      :target="componentTag === 'a' ? (newTab ? '_blank' : '_self') : null"
      :rel="componentTag === 'a' && newTab ? 'noopener noreferrer' : null"
      class="mt-auto inline-block text-center bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded text-sm transition"
    >
      🌐 {{ $t('demoBox.demo_button') }}
    </component>
  </div>
</template>

<script>
export default {
  name: 'DemoBox',
  props: {
    title: { type: String, required: true },
    description: { type: String, default: '' },
    link: { type: String, required: true },
    /**
     * Kako da renderujemo link:
     *  - 'auto'   → heuristika (SPA rute kao router-link, /prezentacije i svi eksterni kao <a>)
     *  - 'router' → uvek router-link
     *  - 'anchor' → uvek <a>
     */
    mode: {
      type: String,
      default: 'auto',
      validator: v => ['auto', 'router', 'anchor'].includes(v),
    },
    /** Da li da otvorimo u novom tabu (važi samo za <a>) */
    newTab: { type: Boolean, default: false },
  },
  computed: {
    isHttpUrl() {
      return /^https?:\/\//i.test(this.link || '')
    },
    isBladeRoute() {
      // Laravel Blade rute koje NISU u SPA ruteru:
      return /^\/(prezentacije|preview)\//i.test(this.link || '')
    },
    isSpaPath() {
      // SPA rute: počinju sa / ali nisu Blade rute tipa /prezentacije/*
      return (this.link || '').startsWith('/') && !this.isBladeRoute
    },
    componentTag() {
      if (this.mode === 'router') return 'router-link'
      if (this.mode === 'anchor') return 'a'
      // auto:
      if (this.isSpaPath) return 'router-link'
      // eksterni http(s) ILI Blade rute → <a>
      return 'a'
    },
    safeLink() {
      const l = (this.link || '').trim()
      if (!l) return '/'
      // dozvoli root-relative putanje i http/https
      if (l.startsWith('/') || this.isHttpUrl) return l
      return '/'
    },
  },
}
</script>
