<script setup>
import Accordion from '../partials/Accordion.vue'

const faqs01 = [
  {
    question: 'Getting started with Simple',
    answer: 'Simple is designed to be user-friendly and intuitive, while Complex is more robust and feature-rich. Both tools are great for creating websites, but Simple is ideal for beginners and small businesses, while Complex is better suited for larger organizations and developers.'
  },
  {
    question: 'Promotional and free plan trials',
    answer: 'Yes, but you\'ll still pay the remainder of the term for the plan you signed up for.'
  },
  {
    question: 'I\'m unable to verify my account',
    answer: 'Yes, but you\'ll still pay the remainder of the term for the plan you signed up for.'
  },
  {
    question: 'Copyright (DMCA) Takedown Notice',
    answer: 'Support is available 24/7 via email, chat, and phone. We\'re here to help you with any questions or concerns you may have.'
  },
  {
    question: 'How to report an unrecognized charge',
    answer: 'Yes! You can invite clients or coworkers to collaborate on your projects, and they can upload their own content.'
  }
]

const faqs02 = [
  {
    question: 'Change with my paid plan',
    answer: 'Simple is designed to be user-friendly and intuitive, while Complex is more robust and feature-rich. Both tools are great for creating websites, but Simple is ideal for beginners and small businesses, while Complex is better suited for larger organizations and developers.'
  },
  {
    question: 'Cancel my subscription',
    answer: 'Yes, but you\'ll still pay the remainder of the term for the plan you signed up for.'
  },
  {
    question: 'I am unable to edit my profile',
    answer: 'Yes, but you\'ll still pay the remainder of the term for the plan you signed up for.'
  },
  {
    question: 'How to delete my account',
    answer: 'Support is available 24/7 via email, chat, and phone. We\'re here to help you with any questions or concerns you may have.'
  },
  {
    question: 'How to reach customer support',
    answer: 'Yes! You can invite clients or coworkers to collaborate on your projects, and they can upload their own content.'
  }
]

const faqs03 = [
  {
    question: 'How to change my password',
    answer: 'Simple is designed to be user-friendly and intuitive, while Complex is more robust and feature-rich. Both tools are great for creating websites, but Simple is ideal for beginners and small businesses, while Complex is better suited for larger organizations and developers.'
  },
  {
    question: 'How to change my email address',
    answer: 'Yes, but you\'ll still pay the remainder of the term for the plan you signed up for.'
  },
  {
    question: 'How to change my username',
    answer: 'Yes, but you\'ll still pay the remainder of the term for the plan you signed up for.'
  },
  {
    question: 'How to change my billing information',
    answer: 'Support is available 24/7 via email, chat, and phone. We\'re here to help you with any questions or concerns you may have.'
  },
  {
    question: 'How to change my notification settings',
    answer: 'Yes! You can invite clients or coworkers to collaborate on your projects, and they can upload their own content.'
  }
]
</script>

<template>
  <section>
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <div class="pb-12 md:pb-20">
        <div class="max-w-3xl mx-auto space-y-12">
          <!-- Getting started -->
          <div>
            <h2 class="text-xl font-bold mb-5">Getting Started</h2>
            <div class="space-y-2">
              <template v-for="(faq, index) in faqs01">
                <Accordion :title="faq.question" :id="`faqs-01-${index}`" :active="faq.active">
                  {{ faq.answer }}
                </Accordion>
              </template>
            </div>
          </div>
          <!-- Profile & plans -->
          <div>
            <h2 class="text-xl font-bold mb-5">Profile & plans</h2>
            <div class="space-y-2">
              <template v-for="(faq, index) in faqs02">
                <Accordion :title="faq.question" :id="`faqs-02-${index}`" :active="faq.active">
                  {{ faq.answer }}
                </Accordion>
              </template>
            </div>
          </div>
          <!-- Accounts -->
          <div>
            <h2 class="text-xl font-bold mb-5">Accounts</h2>
            <div class="space-y-2">
              <template v-for="(faq, index) in faqs03">
                <Accordion :title="faq.question" :id="`faqs-03-${index}`" :active="faq.active">
                  {{ faq.answer }}
                </Accordion>
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>