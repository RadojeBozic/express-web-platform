<script setup>
import { computed } from 'vue'
import { useI18n } from 'vue-i18n'

import ArticleSection from '@/blog/components/ArticleSection.vue'
import ArticleCallout from '@/blog/components/ArticleCallout.vue'
import ArticleChecklist from '@/blog/components/ArticleChecklist.vue'
import ArticleImage from '@/blog/components/ArticleImage.vue'
import ArticleCta from '@/blog/components/ArticleCta.vue'

const { t } = useI18n()

const commonProblems = computed(() => [
  {
    title: t(
      'blog.articles.ecommerceGrowth.problems.traffic.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.problems.traffic.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.problems.products.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.problems.products.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.problems.trust.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.problems.trust.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.problems.checkout.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.problems.checkout.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.problems.followUp.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.problems.followUp.description',
    ),
  },
])

const trustElements = computed(() => [
  {
    title: t(
      'blog.articles.ecommerceGrowth.trust.contact.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.trust.contact.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.trust.delivery.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.trust.delivery.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.trust.returns.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.trust.returns.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.trust.reviews.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.trust.reviews.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.trust.security.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.trust.security.description',
    ),
  },
])

const conversionSteps = computed(() => [
  {
    title: t(
      'blog.articles.ecommerceGrowth.conversion.photos.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.conversion.photos.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.conversion.description.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.conversion.description.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.conversion.price.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.conversion.price.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.conversion.cta.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.conversion.cta.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.conversion.mobile.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.conversion.mobile.description',
    ),
  },
])

const lowBudgetChannels = computed(() => [
  {
    title: t(
      'blog.articles.ecommerceGrowth.channels.seo.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.channels.seo.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.channels.content.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.channels.content.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.channels.googleBusiness.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.channels.googleBusiness.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.channels.social.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.channels.social.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.channels.email.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.channels.email.description',
    ),
  },
])

const repeatCustomerSteps = computed(() => [
  {
    title: t(
      'blog.articles.ecommerceGrowth.retention.communication.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.retention.communication.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.retention.support.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.retention.support.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.retention.reminder.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.retention.reminder.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.retention.offer.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.retention.offer.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.retention.feedback.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.retention.feedback.description',
    ),
  },
])

const actionPlan = computed(() => [
  {
    title: t(
      'blog.articles.ecommerceGrowth.plan.products.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.plan.products.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.plan.mobile.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.plan.mobile.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.plan.trust.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.plan.trust.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.plan.content.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.plan.content.description',
    ),
  },
  {
    title: t(
      'blog.articles.ecommerceGrowth.plan.measurement.title',
    ),
    description: t(
      'blog.articles.ecommerceGrowth.plan.measurement.description',
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
        {{ t('blog.articles.ecommerceGrowth.lead.first') }}
      </p>

      <p>
        {{ t('blog.articles.ecommerceGrowth.lead.second') }}
      </p>
    </ArticleSection>

    <!-- <ArticleImage
      src="/images/blog/ecommerce-growth/hero.jpg"
      :alt="t('blog.articles.ecommerceGrowth.images.hero.alt')"
      :caption="
        t('blog.articles.ecommerceGrowth.images.hero.caption')
      "
    /> -->

    <!-- ================================================== -->
    <!-- 02. PRODAJA NIJE SAMO PITANJE SAOBRAĆAJA           -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.ecommerceGrowth.introduction.title')
      "
    >
      <p>
        {{
          t('blog.articles.ecommerceGrowth.introduction.first')
        }}
      </p>

      <p>
        {{
          t('blog.articles.ecommerceGrowth.introduction.second')
        }}
      </p>

      <p>
        {{
          t('blog.articles.ecommerceGrowth.introduction.third')
        }}
      </p>
    </ArticleSection>

    <ArticleCallout
      type="info"
      :title="
        t('blog.articles.ecommerceGrowth.principle.title')
      "
    >
      <p>
        {{ t('blog.articles.ecommerceGrowth.principle.text') }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 03. ZAŠTO PRODAVNICA NE PRODAJE DOVOLJNO           -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.ecommerceGrowth.problems.title')
      "
    >
      <p>
        {{ t('blog.articles.ecommerceGrowth.problems.intro') }}
      </p>

      <ArticleChecklist :items="commonProblems" />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 04. POVERENJE                                      -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.ecommerceGrowth.trust.title')
      "
    >
      <p>
        {{ t('blog.articles.ecommerceGrowth.trust.intro') }}
      </p>

      <ArticleChecklist :items="trustElements" />
    </ArticleSection>

    <ArticleImage
      src="/images/blog/ecommerce-growth/trust.jpg"
      :alt="t('blog.articles.ecommerceGrowth.images.trust.alt')"
      :caption="
        t('blog.articles.ecommerceGrowth.images.trust.caption')
      "
    />

    <!-- ================================================== -->
    <!-- 05. KONVERZIJA                                     -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.ecommerceGrowth.conversion.title')
      "
    >
      <p>
        {{ t('blog.articles.ecommerceGrowth.conversion.intro') }}
      </p>

      <ArticleChecklist :items="conversionSteps" />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 06. PROIZVODNA STRANICA                            -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.ecommerceGrowth.productPage.title')
      "
    >
      <p>
        {{
          t('blog.articles.ecommerceGrowth.productPage.first')
        }}
      </p>

      <p>
        {{
          t('blog.articles.ecommerceGrowth.productPage.second')
        }}
      </p>

      <p>
        {{
          t('blog.articles.ecommerceGrowth.productPage.third')
        }}
      </p>
    </ArticleSection>

    <ArticleImage
      src="/images/blog/ecommerce-growth/conversion.jpg"
      :alt="
        t('blog.articles.ecommerceGrowth.images.conversion.alt')
      "
      :caption="
        t(
          'blog.articles.ecommerceGrowth.images.conversion.caption',
        )
      "
    />

    <!-- ================================================== -->
    <!-- 07. MARKETING BEZ VELIKOG BUDŽETA                  -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.ecommerceGrowth.channels.title')
      "
    >
      <p>
        {{ t('blog.articles.ecommerceGrowth.channels.intro') }}
      </p>

      <ArticleChecklist :items="lowBudgetChannels" />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 08. POSTOJEĆI KUPCI                                -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.ecommerceGrowth.retention.title')
      "
    >
      <p>
        {{ t('blog.articles.ecommerceGrowth.retention.intro') }}
      </p>

      <ArticleChecklist :items="repeatCustomerSteps" />
    </ArticleSection>

    <ArticleCallout
      type="success"
      :title="
        t('blog.articles.ecommerceGrowth.retentionCallout.title')
      "
    >
      <p>
        {{
          t('blog.articles.ecommerceGrowth.retentionCallout.text')
        }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 09. MERENJE                                        -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.ecommerceGrowth.measurement.title')
      "
    >
      <p>
        {{
          t('blog.articles.ecommerceGrowth.measurement.first')
        }}
      </p>

      <p>
        {{
          t('blog.articles.ecommerceGrowth.measurement.second')
        }}
      </p>

      <p>
        {{
          t('blog.articles.ecommerceGrowth.measurement.third')
        }}
      </p>
    </ArticleSection>

    <ArticleCallout
      type="warning"
      :title="
        t('blog.articles.ecommerceGrowth.warning.title')
      "
    >
      <p>
        {{ t('blog.articles.ecommerceGrowth.warning.text') }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 10. PLAN ZA NAREDNIH 30 DANA                       -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.ecommerceGrowth.plan.title')
      "
    >
      <p>
        {{ t('blog.articles.ecommerceGrowth.plan.intro') }}
      </p>

      <ArticleChecklist
        ordered
        :items="actionPlan"
      />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 11. EXPRESS WEB PREPORUKA                          -->
    <!-- ================================================== -->

    <ArticleCallout
      type="success"
      :title="
        t(
          'blog.articles.ecommerceGrowth.recommendation.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.ecommerceGrowth.recommendation.text',
          )
        }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 12. ZAKLJUČAK                                      -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.ecommerceGrowth.conclusion.title')
      "
    >
      <p>
        {{
          t('blog.articles.ecommerceGrowth.conclusion.first')
        }}
      </p>

      <p>
        {{
          t('blog.articles.ecommerceGrowth.conclusion.second')
        }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 13. CTA                                            -->
    <!-- ================================================== -->

    <ArticleCta
      :title="t('blog.articles.ecommerceGrowth.cta.title')"
      :description="
        t('blog.articles.ecommerceGrowth.cta.description')
      "
      :primary-text="
        t('blog.articles.ecommerceGrowth.cta.primary')
      "
      primary-link="/contact"
      :secondary-text="
        t('blog.articles.ecommerceGrowth.cta.secondary')
      "
      secondary-link="/services/basicshop"
    />
  </article>
</template>