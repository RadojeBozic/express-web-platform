<script setup>
import { computed } from 'vue'
import { useI18n } from 'vue-i18n'

import ArticleSection from '@/blog/components/ArticleSection.vue'
import ArticleCallout from '@/blog/components/ArticleCallout.vue'
import ArticleChecklist from '@/blog/components/ArticleChecklist.vue'
import ArticleImage from '@/blog/components/ArticleImage.vue'
import ArticleCta from '@/blog/components/ArticleCta.vue'

const { t } = useI18n()

const commonMistakes = computed(() => [
  {
    title: t(
      'blog.articles.websiteMistakes.mistakes.noGoal.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.mistakes.noGoal.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.mistakes.forOwner.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.mistakes.forOwner.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.mistakes.unclearMessage.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.mistakes.unclearMessage.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.mistakes.tooMuchContent.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.mistakes.tooMuchContent.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.mistakes.weakMobile.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.mistakes.weakMobile.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.mistakes.noTrust.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.mistakes.noTrust.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.mistakes.weakCta.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.mistakes.weakCta.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.mistakes.noSeo.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.mistakes.noSeo.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.mistakes.noMeasurement.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.mistakes.noMeasurement.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.mistakes.noDevelopment.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.mistakes.noDevelopment.description',
    ),
  },
])

const planningQuestions = computed(() => [
  {
    title: t(
      'blog.articles.websiteMistakes.planning.audience.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.planning.audience.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.planning.problem.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.planning.problem.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.planning.action.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.planning.action.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.planning.proof.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.planning.proof.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.planning.measurement.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.planning.measurement.description',
    ),
  },
])

const qualityChecklist = computed(() => [
  {
    title: t(
      'blog.articles.websiteMistakes.checklist.message.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.checklist.message.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.checklist.navigation.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.checklist.navigation.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.checklist.mobile.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.checklist.mobile.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.checklist.performance.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.checklist.performance.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.checklist.contact.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.checklist.contact.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.checklist.seo.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.checklist.seo.description',
    ),
  },
  {
    title: t(
      'blog.articles.websiteMistakes.checklist.analytics.title',
    ),
    description: t(
      'blog.articles.websiteMistakes.checklist.analytics.description',
    ),
  },
])
</script>

<template>
  <article>
    <!-- ================================================== -->
    <!-- 01. UVOD                                           -->
    <!-- ================================================== -->

    <ArticleSection lead>
      <p>
        {{ t('blog.articles.websiteMistakes.lead.first') }}
      </p>

      <p>
        {{ t('blog.articles.websiteMistakes.lead.second') }}
      </p>
    </ArticleSection>

    <!-- <ArticleImage
      src="/images/blog/website-mistakes/hero.jpg"
      :alt="
        t('blog.articles.websiteMistakes.images.hero.alt')
      "
      :caption="
        t('blog.articles.websiteMistakes.images.hero.caption')
      "
    /> -->

    <!-- ================================================== -->
    <!-- 02. PROBLEM NIJE SAMO U DIZAJNU                    -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.websiteMistakes.introduction.title')
      "
    >
      <p>
        {{
          t('blog.articles.websiteMistakes.introduction.first')
        }}
      </p>

      <p>
        {{
          t('blog.articles.websiteMistakes.introduction.second')
        }}
      </p>

      <p>
        {{
          t('blog.articles.websiteMistakes.introduction.third')
        }}
      </p>
    </ArticleSection>

    <ArticleCallout
      type="info"
      :title="
        t('blog.articles.websiteMistakes.principle.title')
      "
    >
      <p>
        {{ t('blog.articles.websiteMistakes.principle.text') }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 03. NAJČEŠĆE GREŠKE                                -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.websiteMistakes.mistakes.title')
      "
    >
      <p>
        {{ t('blog.articles.websiteMistakes.mistakes.intro') }}
      </p>

      <ArticleChecklist :items="commonMistakes" />
    </ArticleSection>

    <ArticleImage
      src="/images/blog/website-mistakes/bad-vs-good.jpg"
      :alt="
        t(
          'blog.articles.websiteMistakes.images.badVsGood.alt',
        )
      "
      :caption="
        t(
          'blog.articles.websiteMistakes.images.badVsGood.caption',
        )
      "
    />

    <!-- ================================================== -->
    <!-- 04. SAJT ZA KORISNIKA                              -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.websiteMistakes.userFocus.title')
      "
    >
      <p>
        {{
          t('blog.articles.websiteMistakes.userFocus.first')
        }}
      </p>

      <p>
        {{
          t('blog.articles.websiteMistakes.userFocus.second')
        }}
      </p>

      <p>
        {{
          t('blog.articles.websiteMistakes.userFocus.third')
        }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 05. PLANIRANJE                                     -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.websiteMistakes.planning.title')
      "
    >
      <p>
        {{ t('blog.articles.websiteMistakes.planning.intro') }}
      </p>

      <ArticleChecklist
        ordered
        :items="planningQuestions"
      />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 06. MOBILNI PRIKAZ                                 -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.websiteMistakes.mobile.title')
      "
    >
      <p>
        {{ t('blog.articles.websiteMistakes.mobile.first') }}
      </p>

      <p>
        {{ t('blog.articles.websiteMistakes.mobile.second') }}
      </p>

      <p>
        {{ t('blog.articles.websiteMistakes.mobile.third') }}
      </p>
    </ArticleSection>

    <ArticleImage
      src="/images/blog/website-mistakes/mobile.jpg"
      :alt="
        t('blog.articles.websiteMistakes.images.mobile.alt')
      "
      :caption="
        t(
          'blog.articles.websiteMistakes.images.mobile.caption',
        )
      "
    />

    <!-- ================================================== -->
    <!-- 07. SEO I MERENJE                                  -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.websiteMistakes.visibility.title')
      "
    >
      <p>
        {{
          t('blog.articles.websiteMistakes.visibility.first')
        }}
      </p>

      <p>
        {{
          t('blog.articles.websiteMistakes.visibility.second')
        }}
      </p>

      <p>
        {{
          t('blog.articles.websiteMistakes.visibility.third')
        }}
      </p>
    </ArticleSection>

    <ArticleCallout
      type="warning"
      :title="
        t('blog.articles.websiteMistakes.warning.title')
      "
    >
      <p>
        {{ t('blog.articles.websiteMistakes.warning.text') }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 08. PROVERA PRE OBJAVLJIVANJA                      -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.websiteMistakes.checklist.title')
      "
    >
      <p>
        {{ t('blog.articles.websiteMistakes.checklist.intro') }}
      </p>

      <ArticleChecklist :items="qualityChecklist" />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 09. POSLE OBJAVLJIVANJA                            -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.websiteMistakes.afterLaunch.title')
      "
    >
      <p>
        {{
          t('blog.articles.websiteMistakes.afterLaunch.first')
        }}
      </p>

      <p>
        {{
          t('blog.articles.websiteMistakes.afterLaunch.second')
        }}
      </p>

      <p>
        {{
          t('blog.articles.websiteMistakes.afterLaunch.third')
        }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 10. EXPRESS WEB PREPORUKA                          -->
    <!-- ================================================== -->

    <ArticleCallout
      type="success"
      :title="
        t(
          'blog.articles.websiteMistakes.recommendation.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.websiteMistakes.recommendation.text',
          )
        }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 11. ZAKLJUČAK                                      -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.websiteMistakes.conclusion.title')
      "
    >
      <p>
        {{
          t('blog.articles.websiteMistakes.conclusion.first')
        }}
      </p>

      <p>
        {{
          t('blog.articles.websiteMistakes.conclusion.second')
        }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 12. CTA                                            -->
    <!-- ================================================== -->

    <ArticleCta
      :title="
        t('blog.articles.websiteMistakes.cta.title')
      "
      :description="
        t('blog.articles.websiteMistakes.cta.description')
      "
      :primary-text="
        t('blog.articles.websiteMistakes.cta.primary')
      "
      primary-link="/contact"
      :secondary-text="
        t('blog.articles.websiteMistakes.cta.secondary')
      "
      secondary-link="/projects"
    />
  </article>
</template>