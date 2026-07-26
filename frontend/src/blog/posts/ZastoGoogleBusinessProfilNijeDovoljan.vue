<script setup>
import { computed } from 'vue'
import { useI18n } from 'vue-i18n'

import ArticleSection from '@/blog/components/ArticleSection.vue'
import ArticleCallout from '@/blog/components/ArticleCallout.vue'
import ArticleChecklist from '@/blog/components/ArticleChecklist.vue'
import ArticleImage from '@/blog/components/ArticleImage.vue'
import ArticleCta from '@/blog/components/ArticleCta.vue'

const { t } = useI18n()

const profileBenefits = computed(() => [
  {
    title: t(
      'blog.articles.googleBusiness.benefits.maps.title',
    ),
    description: t(
      'blog.articles.googleBusiness.benefits.maps.description',
    ),
  },
  {
    title: t(
      'blog.articles.googleBusiness.benefits.contact.title',
    ),
    description: t(
      'blog.articles.googleBusiness.benefits.contact.description',
    ),
  },
  {
    title: t(
      'blog.articles.googleBusiness.benefits.reviews.title',
    ),
    description: t(
      'blog.articles.googleBusiness.benefits.reviews.description',
    ),
  },
  {
    title: t(
      'blog.articles.googleBusiness.benefits.updates.title',
    ),
    description: t(
      'blog.articles.googleBusiness.benefits.updates.description',
    ),
  },
  {
    title: t(
      'blog.articles.googleBusiness.benefits.insights.title',
    ),
    description: t(
      'blog.articles.googleBusiness.benefits.insights.description',
    ),
  },
])

const profileLimitations = computed(() => [
  {
    title: t(
      'blog.articles.googleBusiness.limitations.control.title',
    ),
    description: t(
      'blog.articles.googleBusiness.limitations.control.description',
    ),
  },
  {
    title: t(
      'blog.articles.googleBusiness.limitations.content.title',
    ),
    description: t(
      'blog.articles.googleBusiness.limitations.content.description',
    ),
  },
  {
    title: t(
      'blog.articles.googleBusiness.limitations.brand.title',
    ),
    description: t(
      'blog.articles.googleBusiness.limitations.brand.description',
    ),
  },
  {
    title: t(
      'blog.articles.googleBusiness.limitations.sales.title',
    ),
    description: t(
      'blog.articles.googleBusiness.limitations.sales.description',
    ),
  },
  {
    title: t(
      'blog.articles.googleBusiness.limitations.dependency.title',
    ),
    description: t(
      'blog.articles.googleBusiness.limitations.dependency.description',
    ),
  },
])

const combinedStrategy = computed(() => [
  {
    title: t(
      'blog.articles.googleBusiness.strategy.profile.title',
    ),
    description: t(
      'blog.articles.googleBusiness.strategy.profile.description',
    ),
  },
  {
    title: t(
      'blog.articles.googleBusiness.strategy.website.title',
    ),
    description: t(
      'blog.articles.googleBusiness.strategy.website.description',
    ),
  },
  {
    title: t(
      'blog.articles.googleBusiness.strategy.content.title',
    ),
    description: t(
      'blog.articles.googleBusiness.strategy.content.description',
    ),
  },
  {
    title: t(
      'blog.articles.googleBusiness.strategy.analytics.title',
    ),
    description: t(
      'blog.articles.googleBusiness.strategy.analytics.description',
    ),
  },
  {
    title: t(
      'blog.articles.googleBusiness.strategy.reputation.title',
    ),
    description: t(
      'blog.articles.googleBusiness.strategy.reputation.description',
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
        {{ t('blog.articles.googleBusiness.lead.first') }}
      </p>

      <p>
        {{ t('blog.articles.googleBusiness.lead.second') }}
      </p>
    </ArticleSection>

    <!-- <ArticleImage
      src="/images/blog/google-business/hero.jpg"
      :alt="
        t('blog.articles.googleBusiness.images.hero.alt')
      "
      :caption="
        t('blog.articles.googleBusiness.images.hero.caption')
      "
    /> -->

    <!-- ================================================== -->
    <!-- 02. ŠTA JE GOOGLE BUSINESS PROFIL                  -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.googleBusiness.profile.title')"
    >
      <p>
        {{ t('blog.articles.googleBusiness.profile.first') }}
      </p>

      <p>
        {{ t('blog.articles.googleBusiness.profile.second') }}
      </p>

      <p>
        {{ t('blog.articles.googleBusiness.profile.third') }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 03. PREDNOSTI PROFILA                              -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.googleBusiness.benefits.title')
      "
    >
      <p>
        {{ t('blog.articles.googleBusiness.benefits.intro') }}
      </p>

      <ArticleChecklist :items="profileBenefits" />
    </ArticleSection>

    <ArticleImage
      src="/images/blog/google-business/business-profile.jpg"
      :alt="
        t(
          'blog.articles.googleBusiness.images.businessProfile.alt',
        )
      "
      :caption="
        t(
          'blog.articles.googleBusiness.images.businessProfile.caption',
        )
      "
    />

    <!-- ================================================== -->
    <!-- 04. ČESTA ZABLUDA                                  -->
    <!-- ================================================== -->

    <ArticleCallout
      type="warning"
      :title="
        t('blog.articles.googleBusiness.warning.title')
      "
    >
      <p>
        {{ t('blog.articles.googleBusiness.warning.text') }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 05. OGRANIČENJA GOOGLE BUSINESS PROFILA            -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.googleBusiness.limitations.title')
      "
    >
      <p>
        {{
          t(
            'blog.articles.googleBusiness.limitations.intro',
          )
        }}
      </p>

      <ArticleChecklist :items="profileLimitations" />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 06. PROFIL ILI SAJT                                -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.googleBusiness.comparison.title')
      "
    >
      <p>
        {{
          t(
            'blog.articles.googleBusiness.comparison.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.googleBusiness.comparison.second',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.googleBusiness.comparison.third',
          )
        }}
      </p>
    </ArticleSection>

    <ArticleImage
      src="/images/blog/google-business/website-vs-profile.jpg"
      :alt="
        t(
          'blog.articles.googleBusiness.images.comparison.alt',
        )
      "
      :caption="
        t(
          'blog.articles.googleBusiness.images.comparison.caption',
        )
      "
    />

    <!-- ================================================== -->
    <!-- 07. NAJBOLJA KOMBINACIJA                           -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.googleBusiness.strategy.title')
      "
    >
      <p>
        {{ t('blog.articles.googleBusiness.strategy.intro') }}
      </p>

      <ArticleChecklist
        ordered
        :items="combinedStrategy"
      />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 08. VAŽAN SAVET                                    -->
    <!-- ================================================== -->

    <ArticleCallout
      type="info"
      :title="
        t('blog.articles.googleBusiness.callout.title')
      "
    >
      <p>
        {{ t('blog.articles.googleBusiness.callout.text') }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 09. RECENZIJE I POVERENJE                          -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.googleBusiness.reviews.title')
      "
    >
      <p>
        {{ t('blog.articles.googleBusiness.reviews.first') }}
      </p>

      <p>
        {{ t('blog.articles.googleBusiness.reviews.second') }}
      </p>

      <p>
        {{ t('blog.articles.googleBusiness.reviews.third') }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 10. EXPRESS WEB PREPORUKA                          -->
    <!-- ================================================== -->

    <ArticleCallout
      type="success"
      :title="
        t(
          'blog.articles.googleBusiness.recommendation.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.googleBusiness.recommendation.text',
          )
        }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 11. ZAKLJUČAK                                      -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.googleBusiness.conclusion.title')
      "
    >
      <p>
        {{
          t(
            'blog.articles.googleBusiness.conclusion.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.googleBusiness.conclusion.second',
          )
        }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 12. CTA                                            -->
    <!-- ================================================== -->

    <ArticleCta
      :title="t('blog.articles.googleBusiness.cta.title')"
      :description="
        t('blog.articles.googleBusiness.cta.description')
      "
      :primary-text="
        t('blog.articles.googleBusiness.cta.primary')
      "
      primary-link="/contact"
      :secondary-text="
        t('blog.articles.googleBusiness.cta.secondary')
      "
      secondary-link="/services/seo"
    />
  </article>
</template>