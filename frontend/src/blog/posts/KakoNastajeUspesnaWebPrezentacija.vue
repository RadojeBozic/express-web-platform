<script setup>
import { computed } from 'vue'
import { useI18n } from 'vue-i18n'

import ArticleSection from '@/blog/components/ArticleSection.vue'
import ArticleCallout from '@/blog/components/ArticleCallout.vue'
import ArticleChecklist from '@/blog/components/ArticleChecklist.vue'
import ArticleImage from '@/blog/components/ArticleImage.vue'
import ArticleCta from '@/blog/components/ArticleCta.vue'

const { t } = useI18n()

const planningSteps = computed(() => [
  {
    title: t(
      'blog.articles.gvpCaseStudy.analysis.expertise.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.analysis.expertise.description',
    ),
  },
  {
    title: t(
      'blog.articles.gvpCaseStudy.analysis.audience.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.analysis.audience.description',
    ),
  },
  {
    title: t(
      'blog.articles.gvpCaseStudy.analysis.trust.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.analysis.trust.description',
    ),
  },
  {
    title: t(
      'blog.articles.gvpCaseStudy.analysis.content.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.analysis.content.description',
    ),
  },
])

const websiteSections = computed(() => [
  {
    title: t(
      'blog.articles.gvpCaseStudy.structure.hero.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.structure.hero.description',
    ),
  },
  {
    title: t(
      'blog.articles.gvpCaseStudy.structure.about.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.structure.about.description',
    ),
  },
  {
    title: t(
      'blog.articles.gvpCaseStudy.structure.services.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.structure.services.description',
    ),
  },
  {
    title: t(
      'blog.articles.gvpCaseStudy.structure.content.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.structure.content.description',
    ),
  },
  {
    title: t(
      'blog.articles.gvpCaseStudy.structure.faq.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.structure.faq.description',
    ),
  },
  {
    title: t(
      'blog.articles.gvpCaseStudy.structure.contact.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.structure.contact.description',
    ),
  },
])

const seoElements = computed(() => [
  {
    title: t(
      'blog.articles.gvpCaseStudy.seo.metadata.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.seo.metadata.description',
    ),
  },
  {
    title: t(
      'blog.articles.gvpCaseStudy.seo.social.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.seo.social.description',
    ),
  },
  {
    title: t(
      'blog.articles.gvpCaseStudy.seo.structuredData.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.seo.structuredData.description',
    ),
  },
  {
    title: t(
      'blog.articles.gvpCaseStudy.seo.indexing.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.seo.indexing.description',
    ),
  },
  {
    title: t(
      'blog.articles.gvpCaseStudy.seo.technical.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.seo.technical.description',
    ),
  },
])

const results = computed(() => [
  {
    title: t(
      'blog.articles.gvpCaseStudy.results.identity.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.results.identity.description',
    ),
  },
  {
    title: t(
      'blog.articles.gvpCaseStudy.results.responsive.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.results.responsive.description',
    ),
  },
  {
    title: t(
      'blog.articles.gvpCaseStudy.results.search.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.results.search.description',
    ),
  },
  {
    title: t(
      'blog.articles.gvpCaseStudy.results.foundation.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.results.foundation.description',
    ),
  },
])

const nextSteps = computed(() => [
  {
    title: t(
      'blog.articles.gvpCaseStudy.development.content.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.development.content.description',
    ),
  },
  {
    title: t(
      'blog.articles.gvpCaseStudy.development.analytics.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.development.analytics.description',
    ),
  },
  {
    title: t(
      'blog.articles.gvpCaseStudy.development.seo.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.development.seo.description',
    ),
  },
  {
    title: t(
      'blog.articles.gvpCaseStudy.development.maintenance.title',
    ),
    description: t(
      'blog.articles.gvpCaseStudy.development.maintenance.description',
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
        {{ t('blog.articles.gvpCaseStudy.lead.first') }}
      </p>

      <p>
        {{ t('blog.articles.gvpCaseStudy.lead.second') }}
      </p>
    </ArticleSection>

    <!-- <ArticleImage
      src="/images/blog/gvp-case-study/hero.jpg"
      :alt="t('blog.articles.gvpCaseStudy.images.hero.alt')"
      :caption="
        t('blog.articles.gvpCaseStudy.images.hero.caption')
      "
    /> -->

    <!-- ================================================== -->
    <!-- 02. POLAZNA SITUACIJA                              -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.gvpCaseStudy.context.title')
      "
    >
      <p>
        {{ t('blog.articles.gvpCaseStudy.context.first') }}
      </p>

      <p>
        {{ t('blog.articles.gvpCaseStudy.context.second') }}
      </p>

      <p>
        {{ t('blog.articles.gvpCaseStudy.context.third') }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 03. ANALIZA                                        -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.gvpCaseStudy.analysis.title')
      "
    >
      <p>
        {{ t('blog.articles.gvpCaseStudy.analysis.intro') }}
      </p>

      <ArticleChecklist :items="planningSteps" />
    </ArticleSection>

    <ArticleCallout
      type="info"
      :title="
        t('blog.articles.gvpCaseStudy.principle.title')
      "
    >
      <p>
        {{ t('blog.articles.gvpCaseStudy.principle.text') }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 04. STRUKTURA SADRŽAJA                             -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.gvpCaseStudy.structure.title')
      "
    >
      <p>
        {{ t('blog.articles.gvpCaseStudy.structure.intro') }}
      </p>

      <ArticleChecklist :items="websiteSections" />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 05. DIZAJN I UX                                    -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.gvpCaseStudy.design.title')
      "
    >
      <p>
        {{ t('blog.articles.gvpCaseStudy.design.first') }}
      </p>

      <p>
        {{ t('blog.articles.gvpCaseStudy.design.second') }}
      </p>

      <p>
        {{ t('blog.articles.gvpCaseStudy.design.third') }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 06. SEO                                            -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.gvpCaseStudy.seo.title')"
    >
      <p>
        {{ t('blog.articles.gvpCaseStudy.seo.intro') }}
      </p>

      <ArticleChecklist :items="seoElements" />
    </ArticleSection>

    <ArticleImage
      src="/images/blog/gvp-case-study/seo.jpg"
      :alt="t('blog.articles.gvpCaseStudy.images.seo.alt')"
      :caption="
        t('blog.articles.gvpCaseStudy.images.seo.caption')
      "
    />

    <!-- ================================================== -->
    <!-- 07. SEARCH CONSOLE                                 -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.gvpCaseStudy.searchConsole.title')
      "
    >
      <p>
        {{
          t('blog.articles.gvpCaseStudy.searchConsole.first')
        }}
      </p>

      <p>
        {{
          t('blog.articles.gvpCaseStudy.searchConsole.second')
        }}
      </p>

      <p>
        {{
          t('blog.articles.gvpCaseStudy.searchConsole.third')
        }}
      </p>
    </ArticleSection>

    <ArticleImage
      src="/images/blog/gvp-case-study/search-console.jpg"
      :alt="
        t(
          'blog.articles.gvpCaseStudy.images.searchConsole.alt',
        )
      "
      :caption="
        t(
          'blog.articles.gvpCaseStudy.images.searchConsole.caption',
        )
      "
    />

    <!-- ================================================== -->
    <!-- 08. OBJAVLJIVANJE NIJE KRAJ                        -->
    <!-- ================================================== -->

    <ArticleCallout
      type="warning"
      :title="
        t('blog.articles.gvpCaseStudy.launch.title')
      "
    >
      <p>
        {{ t('blog.articles.gvpCaseStudy.launch.text') }}
      </p>
    </ArticleCallout>

    <ArticleSection
      :title="
        t('blog.articles.gvpCaseStudy.development.title')
      "
    >
      <p>
        {{
          t('blog.articles.gvpCaseStudy.development.intro')
        }}
      </p>

      <ArticleChecklist :items="nextSteps" />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 09. REZULTATI                                      -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.gvpCaseStudy.results.title')
      "
    >
      <p>
        {{ t('blog.articles.gvpCaseStudy.results.intro') }}
      </p>

      <ArticleChecklist :items="results" />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 10. LEKCIJE                                        -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.gvpCaseStudy.lessons.title')
      "
    >
      <p>
        {{ t('blog.articles.gvpCaseStudy.lessons.first') }}
      </p>

      <p>
        {{ t('blog.articles.gvpCaseStudy.lessons.second') }}
      </p>

      <p>
        {{ t('blog.articles.gvpCaseStudy.lessons.third') }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 11. EXPRESS WEB PREPORUKA                          -->
    <!-- ================================================== -->

    <ArticleCallout
      type="success"
      :title="
        t('blog.articles.gvpCaseStudy.recommendation.title')
      "
    >
      <p>
        {{
          t('blog.articles.gvpCaseStudy.recommendation.text')
        }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 12. ZAKLJUČAK                                      -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.gvpCaseStudy.conclusion.title')
      "
    >
      <p>
        {{
          t('blog.articles.gvpCaseStudy.conclusion.first')
        }}
      </p>

      <p>
        {{
          t('blog.articles.gvpCaseStudy.conclusion.second')
        }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 13. CTA                                            -->
    <!-- ================================================== -->

    <ArticleCta
      :title="t('blog.articles.gvpCaseStudy.cta.title')"
      :description="
        t('blog.articles.gvpCaseStudy.cta.description')
      "
      :primary-text="
        t('blog.articles.gvpCaseStudy.cta.primary')
      "
      primary-link="/contact"
      :secondary-text="
        t('blog.articles.gvpCaseStudy.cta.secondary')
      "
      secondary-link="/projects"
    />
  </article>
</template>