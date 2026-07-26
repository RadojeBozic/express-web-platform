<script setup>
import { computed } from 'vue'
import { useI18n } from 'vue-i18n'

import ArticleSection from '@/blog/components/ArticleSection.vue'
import ArticleCallout from '@/blog/components/ArticleCallout.vue'
import ArticleChecklist from '@/blog/components/ArticleChecklist.vue'
import ArticleImage from '@/blog/components/ArticleImage.vue'
import ArticleCta from '@/blog/components/ArticleCta.vue'

const { t } = useI18n()

const readinessSigns = computed(() => [
  {
    title: t(
      'blog.articles.onlineStore.readiness.products.title',
    ),
    description: t(
      'blog.articles.onlineStore.readiness.products.description',
    ),
  },
  {
    title: t(
      'blog.articles.onlineStore.readiness.catalog.title',
    ),
    description: t(
      'blog.articles.onlineStore.readiness.catalog.description',
    ),
  },
  {
    title: t(
      'blog.articles.onlineStore.readiness.delivery.title',
    ),
    description: t(
      'blog.articles.onlineStore.readiness.delivery.description',
    ),
  },
  {
    title: t(
      'blog.articles.onlineStore.readiness.support.title',
    ),
    description: t(
      'blog.articles.onlineStore.readiness.support.description',
    ),
  },
  {
    title: t(
      'blog.articles.onlineStore.readiness.marketing.title',
    ),
    description: t(
      'blog.articles.onlineStore.readiness.marketing.description',
    ),
  },
])

const preparationItems = computed(() => [
  {
    title: t(
      'blog.articles.onlineStore.preparation.photos.title',
    ),
    description: t(
      'blog.articles.onlineStore.preparation.photos.description',
    ),
  },
  {
    title: t(
      'blog.articles.onlineStore.preparation.descriptions.title',
    ),
    description: t(
      'blog.articles.onlineStore.preparation.descriptions.description',
    ),
  },
  {
    title: t(
      'blog.articles.onlineStore.preparation.prices.title',
    ),
    description: t(
      'blog.articles.onlineStore.preparation.prices.description',
    ),
  },
  {
    title: t(
      'blog.articles.onlineStore.preparation.payment.title',
    ),
    description: t(
      'blog.articles.onlineStore.preparation.payment.description',
    ),
  },
  {
    title: t(
      'blog.articles.onlineStore.preparation.shipping.title',
    ),
    description: t(
      'blog.articles.onlineStore.preparation.shipping.description',
    ),
  },
  {
    title: t(
      'blog.articles.onlineStore.preparation.returns.title',
    ),
    description: t(
      'blog.articles.onlineStore.preparation.returns.description',
    ),
  },
  {
    title: t(
      'blog.articles.onlineStore.preparation.legal.title',
    ),
    description: t(
      'blog.articles.onlineStore.preparation.legal.description',
    ),
  },
])

const launchSteps = computed(() => [
  {
    title: t(
      'blog.articles.onlineStore.steps.assessment.title',
    ),
    description: t(
      'blog.articles.onlineStore.steps.assessment.description',
    ),
  },
  {
    title: t(
      'blog.articles.onlineStore.steps.scope.title',
    ),
    description: t(
      'blog.articles.onlineStore.steps.scope.description',
    ),
  },
  {
    title: t(
      'blog.articles.onlineStore.steps.operations.title',
    ),
    description: t(
      'blog.articles.onlineStore.steps.operations.description',
    ),
  },
  {
    title: t(
      'blog.articles.onlineStore.steps.platform.title',
    ),
    description: t(
      'blog.articles.onlineStore.steps.platform.description',
    ),
  },
  {
    title: t(
      'blog.articles.onlineStore.steps.promotion.title',
    ),
    description: t(
      'blog.articles.onlineStore.steps.promotion.description',
    ),
  },
])
</script>

<template>
  <article>
    <!-- ================================================== -->
    <!-- 01. UVOD / LEAD                                    -->
    <!-- ================================================== -->

    <ArticleSection lead>
      <p>
        {{ t('blog.articles.onlineStore.lead.first') }}
      </p>

      <p>
        {{ t('blog.articles.onlineStore.lead.second') }}
      </p>
    </ArticleSection>

    <!-- <ArticleImage
      src="/images/blog/online-store/hero.jpg"
      :alt="t('blog.articles.onlineStore.images.hero.alt')"
      :caption="
        t('blog.articles.onlineStore.images.hero.caption')
      "
    /> -->

    <!-- ================================================== -->
    <!-- 02. DA LI JE PRODAVNICA PRAVI KORAK                -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.onlineStore.need.title')"
    >
      <p>
        {{ t('blog.articles.onlineStore.need.first') }}
      </p>

      <p>
        {{ t('blog.articles.onlineStore.need.second') }}
      </p>

      <p>
        {{ t('blog.articles.onlineStore.need.third') }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 03. ZNACI SPREMNOSTI                               -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.onlineStore.readiness.title')"
    >
      <p>
        {{ t('blog.articles.onlineStore.readiness.intro') }}
      </p>

      <ArticleChecklist :items="readinessSigns" />
    </ArticleSection>

    <ArticleCallout
      type="warning"
      :title="t('blog.articles.onlineStore.warning.title')"
    >
      <p>
        {{ t('blog.articles.onlineStore.warning.text') }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 04. PRIPREMA                                       -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.onlineStore.preparation.title')"
    >
      <p>
        {{ t('blog.articles.onlineStore.preparation.intro') }}
      </p>

      <ArticleChecklist :items="preparationItems" />
    </ArticleSection>

    <ArticleImage
      src="/images/blog/online-store/preparation.jpg"
      :alt="
        t('blog.articles.onlineStore.images.preparation.alt')
      "
      :caption="
        t(
          'blog.articles.onlineStore.images.preparation.caption',
        )
      "
    />

    <!-- ================================================== -->
    <!-- 05. TEHNOLOGIJA I ORGANIZACIJA                     -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.onlineStore.technology.title')"
    >
      <p>
        {{ t('blog.articles.onlineStore.technology.first') }}
      </p>

      <p>
        {{ t('blog.articles.onlineStore.technology.second') }}
      </p>

      <p>
        {{ t('blog.articles.onlineStore.technology.third') }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 06. MARKETING                                      -->
    <!-- ================================================== -->

    <ArticleCallout
      type="info"
      :title="t('blog.articles.onlineStore.marketing.title')"
    >
      <p>
        {{ t('blog.articles.onlineStore.marketing.text') }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 07. PRODAVNICA ILI MARKETPLACE                     -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.onlineStore.marketplace.title')"
    >
      <p>
        {{ t('blog.articles.onlineStore.marketplace.first') }}
      </p>

      <p>
        {{ t('blog.articles.onlineStore.marketplace.second') }}
      </p>

      <p>
        {{ t('blog.articles.onlineStore.marketplace.third') }}
      </p>
    </ArticleSection>

    <ArticleImage
      src="/images/blog/online-store/marketplace.jpg"
      :alt="
        t('blog.articles.onlineStore.images.marketplace.alt')
      "
      :caption="
        t(
          'blog.articles.onlineStore.images.marketplace.caption',
        )
      "
    />

    <!-- ================================================== -->
    <!-- 08. KORACI                                         -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.onlineStore.steps.title')"
    >
      <p>
        {{ t('blog.articles.onlineStore.steps.intro') }}
      </p>

      <ArticleChecklist
        ordered
        :items="launchSteps"
      />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 09. EXPRESS WEB PREPORUKA                           -->
    <!-- ================================================== -->

    <ArticleCallout
      type="success"
      :title="
        t('blog.articles.onlineStore.recommendation.title')
      "
    >
      <p>
        {{
          t('blog.articles.onlineStore.recommendation.text')
        }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 10. ZAKLJUČAK                                      -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.onlineStore.conclusion.title')"
    >
      <p>
        {{ t('blog.articles.onlineStore.conclusion.first') }}
      </p>

      <p>
        {{ t('blog.articles.onlineStore.conclusion.second') }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 11. CTA                                            -->
    <!-- ================================================== -->

    <ArticleCta
      :title="t('blog.articles.onlineStore.cta.title')"
      :description="
        t('blog.articles.onlineStore.cta.description')
      "
      :primary-text="
        t('blog.articles.onlineStore.cta.primary')
      "
      primary-link="/contact"
      :secondary-text="
        t('blog.articles.onlineStore.cta.secondary')
      "
      secondary-link="/services/basicshop"
    />
  </article>
</template>