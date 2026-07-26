<template>
  <section class="bg-slate-800 py-16">
    <div class="max-w-4xl mx-auto px-4">
      <h3 class="text-2xl font-semibold text-white text-center mb-8">{{ $t('support.faq_title') }}</h3>
      <div class="space-y-4">
        <Accordion v-for="(faq, index) in faqs" :key="index" :title="faq.question">
          {{ faq.answer }}
        </Accordion>
      </div>
    </div>
  </section>
</template>

<script>
import Accordion from './Accordion.vue'

export default {
  name: 'SupportAccordion',
  components: { Accordion },
  data() {
    return {
      faqs: [
        {
          question: this.$t('support.faq.0.q'),
          answer: this.$t('support.faq.0.a'),
        },
        {
          question: this.$t('support.faq.1.q'),
          answer: this.$t('support.faq.1.a'),
        },
        {
          question: this.$t('support.faq.2.q'),
          answer: this.$t('support.faq.2.a'),
        },
      ],
    }
  },
}
</script>
