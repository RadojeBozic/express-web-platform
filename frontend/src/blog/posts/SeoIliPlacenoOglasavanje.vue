<script setup>
import { computed } from 'vue'
import { useI18n } from 'vue-i18n'

import ArticleSection from '@/blog/components/ArticleSection.vue'
import ArticleCallout from '@/blog/components/ArticleCallout.vue'
import ArticleChecklist from '@/blog/components/ArticleChecklist.vue'
import ArticleImage from '@/blog/components/ArticleImage.vue'
import ArticleCta from '@/blog/components/ArticleCta.vue'

const { t } = useI18n()

const seoAdvantages = computed(() => [
  {
    title: t(
      'blog.articles.seoVsPaid.seoAdvantages.visibility.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.seoAdvantages.visibility.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.seoAdvantages.trust.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.seoAdvantages.trust.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.seoAdvantages.content.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.seoAdvantages.content.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.seoAdvantages.longTerm.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.seoAdvantages.longTerm.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.seoAdvantages.learning.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.seoAdvantages.learning.description',
    ),
  },
])

const paidAdvantages = computed(() => [
  {
    title: t(
      'blog.articles.seoVsPaid.paidAdvantages.speed.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.paidAdvantages.speed.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.paidAdvantages.targeting.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.paidAdvantages.targeting.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.paidAdvantages.testing.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.paidAdvantages.testing.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.paidAdvantages.seasonal.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.paidAdvantages.seasonal.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.paidAdvantages.control.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.paidAdvantages.control.description',
    ),
  },
])

const decisionFactors = computed(() => [
  {
    title: t(
      'blog.articles.seoVsPaid.decision.urgency.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.decision.urgency.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.decision.demand.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.decision.demand.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.decision.website.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.decision.website.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.decision.budget.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.decision.budget.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.decision.capacity.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.decision.capacity.description',
    ),
  },
])

const recommendedScenarios = computed(() => [
  {
    title: t(
      'blog.articles.seoVsPaid.scenarios.newBusiness.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.scenarios.newBusiness.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.scenarios.localBusiness.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.scenarios.localBusiness.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.scenarios.ecommerce.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.scenarios.ecommerce.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.scenarios.consulting.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.scenarios.consulting.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.scenarios.seasonal.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.scenarios.seasonal.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.scenarios.longTerm.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.scenarios.longTerm.description',
    ),
  },
])

const startingPlan = computed(() => [
  {
    title: t(
      'blog.articles.seoVsPaid.plan.foundation.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.plan.foundation.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.plan.measurement.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.plan.measurement.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.plan.testCampaign.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.plan.testCampaign.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.plan.content.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.plan.content.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.plan.optimisation.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.plan.optimisation.description',
    ),
  },
])

const mistakes = computed(() => [
  {
    title: t(
      'blog.articles.seoVsPaid.mistakes.adsWithoutPage.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.mistakes.adsWithoutPage.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.mistakes.seoWithoutContent.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.mistakes.seoWithoutContent.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.mistakes.noTracking.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.mistakes.noTracking.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.mistakes.tooManyChannels.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.mistakes.tooManyChannels.description',
    ),
  },
  {
    title: t(
      'blog.articles.seoVsPaid.mistakes.quickJudgement.title',
    ),
    description: t(
      'blog.articles.seoVsPaid.mistakes.quickJudgement.description',
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
        {{ t('blog.articles.seoVsPaid.lead.first') }}
      </p>

      <p>
        {{ t('blog.articles.seoVsPaid.lead.second') }}
      </p>
    </ArticleSection>

    <!-- <ArticleImage
      src="/images/blog/seo-vs-paid/hero.jpg"
      :alt="t('blog.articles.seoVsPaid.images.hero.alt')"
      :caption="
        t('blog.articles.seoVsPaid.images.hero.caption')
      "
    /> -->

    <!-- ================================================== -->
    <!-- 02. POGREŠNO PITANJE                               -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.seoVsPaid.introduction.title')"
    >
      <p>
        {{ t('blog.articles.seoVsPaid.introduction.first') }}
      </p>

      <p>
        {{ t('blog.articles.seoVsPaid.introduction.second') }}
      </p>

      <p>
        {{ t('blog.articles.seoVsPaid.introduction.third') }}
      </p>
    </ArticleSection>

    <ArticleCallout
      type="info"
      :title="t('blog.articles.seoVsPaid.principle.title')"
    >
      <p>
        {{ t('blog.articles.seoVsPaid.principle.text') }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 03. ŠTA JE SEO                                     -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.seoVsPaid.seo.title')"
    >
      <p>
        {{ t('blog.articles.seoVsPaid.seo.first') }}
      </p>

      <p>
        {{ t('blog.articles.seoVsPaid.seo.second') }}
      </p>

      <p>
        {{ t('blog.articles.seoVsPaid.seo.third') }}
      </p>

      <ArticleChecklist :items="seoAdvantages" />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 04. ŠTA JE PLAĆENO OGLAŠAVANJE                     -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.seoVsPaid.paid.title')"
    >
      <p>
        {{ t('blog.articles.seoVsPaid.paid.first') }}
      </p>

      <p>
        {{ t('blog.articles.seoVsPaid.paid.second') }}
      </p>

      <p>
        {{ t('blog.articles.seoVsPaid.paid.third') }}
      </p>

      <ArticleChecklist :items="paidAdvantages" />
    </ArticleSection>

    <ArticleImage
      src="/images/blog/seo-vs-paid/seo-vs-ads.jpg"
      :alt="t('blog.articles.seoVsPaid.images.comparison.alt')"
      :caption="
        t('blog.articles.seoVsPaid.images.comparison.caption')
      "
    />

    <!-- ================================================== -->
    <!-- 05. KAKO DONETI ODLUKU                             -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.seoVsPaid.decision.title')"
    >
      <p>
        {{ t('blog.articles.seoVsPaid.decision.intro') }}
      </p>

      <ArticleChecklist :items="decisionFactors" />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 06. PRAKTIČNI SCENARIJI                            -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.seoVsPaid.scenarios.title')"
    >
      <p>
        {{ t('blog.articles.seoVsPaid.scenarios.intro') }}
      </p>

      <ArticleChecklist :items="recommendedScenarios" />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 07. KOMBINACIJA                                    -->
    <!-- ================================================== -->

    <ArticleCallout
      type="success"
      :title="t('blog.articles.seoVsPaid.combination.title')"
    >
      <p>
        {{ t('blog.articles.seoVsPaid.combination.text') }}
      </p>
    </ArticleCallout>

    <ArticleSection
      :title="t('blog.articles.seoVsPaid.system.title')"
    >
      <p>
        {{ t('blog.articles.seoVsPaid.system.first') }}
      </p>

      <p>
        {{ t('blog.articles.seoVsPaid.system.second') }}
      </p>

      <p>
        {{ t('blog.articles.seoVsPaid.system.third') }}
      </p>
    </ArticleSection>

    <ArticleImage
      src="/images/blog/seo-vs-paid/long-term.jpg"
      :alt="t('blog.articles.seoVsPaid.images.longTerm.alt')"
      :caption="
        t('blog.articles.seoVsPaid.images.longTerm.caption')
      "
    />

    <!-- ================================================== -->
    <!-- 08. PRAKTIČAN PLAN                                 -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.seoVsPaid.plan.title')"
    >
      <p>
        {{ t('blog.articles.seoVsPaid.plan.intro') }}
      </p>

      <ArticleChecklist
        ordered
        :items="startingPlan"
      />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 09. NAJČEŠĆE GREŠKE                                -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.seoVsPaid.mistakes.title')"
    >
      <p>
        {{ t('blog.articles.seoVsPaid.mistakes.intro') }}
      </p>

      <ArticleChecklist :items="mistakes" />
    </ArticleSection>

    <ArticleCallout
      type="warning"
      :title="t('blog.articles.seoVsPaid.warning.title')"
    >
      <p>
        {{ t('blog.articles.seoVsPaid.warning.text') }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 10. MERENJE                                        -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.seoVsPaid.measurement.title')"
    >
      <p>
        {{ t('blog.articles.seoVsPaid.measurement.first') }}
      </p>

      <p>
        {{ t('blog.articles.seoVsPaid.measurement.second') }}
      </p>

      <p>
        {{ t('blog.articles.seoVsPaid.measurement.third') }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 11. EXPRESS WEB PREPORUKA                          -->
    <!-- ================================================== -->

    <ArticleCallout
      type="success"
      :title="t('blog.articles.seoVsPaid.recommendation.title')"
    >
      <p>
        {{ t('blog.articles.seoVsPaid.recommendation.text') }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 12. ZAKLJUČAK                                      -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.seoVsPaid.conclusion.title')"
    >
      <p>
        {{ t('blog.articles.seoVsPaid.conclusion.first') }}
      </p>

      <p>
        {{ t('blog.articles.seoVsPaid.conclusion.second') }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 13. CTA                                            -->
    <!-- ================================================== -->

    <ArticleCta
      :title="t('blog.articles.seoVsPaid.cta.title')"
      :description="
        t('blog.articles.seoVsPaid.cta.description')
      "
      :primary-text="
        t('blog.articles.seoVsPaid.cta.primary')
      "
      primary-link="/contact"
      :secondary-text="
        t('blog.articles.seoVsPaid.cta.secondary')
      "
      secondary-link="/services/seo"
    />
  </article>
</template>