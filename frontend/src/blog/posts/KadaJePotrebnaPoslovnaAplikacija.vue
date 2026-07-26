<script setup>
import { computed } from 'vue'
import { useI18n } from 'vue-i18n'

import ArticleSection from '@/blog/components/ArticleSection.vue'
import ArticleCallout from '@/blog/components/ArticleCallout.vue'
import ArticleChecklist from '@/blog/components/ArticleChecklist.vue'
import ArticleImage from '@/blog/components/ArticleImage.vue'
import ArticleCta from '@/blog/components/ArticleCta.vue'

const { t } = useI18n()

const warningSigns = computed(() => [
  {
    title: t(
      'blog.articles.businessApplication.signs.duplicateEntry.title',
    ),
    description: t(
      'blog.articles.businessApplication.signs.duplicateEntry.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessApplication.signs.scatteredData.title',
    ),
    description: t(
      'blog.articles.businessApplication.signs.scatteredData.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessApplication.signs.manualTracking.title',
    ),
    description: t(
      'blog.articles.businessApplication.signs.manualTracking.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessApplication.signs.noOverview.title',
    ),
    description: t(
      'blog.articles.businessApplication.signs.noOverview.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessApplication.signs.errors.title',
    ),
    description: t(
      'blog.articles.businessApplication.signs.errors.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessApplication.signs.reporting.title',
    ),
    description: t(
      'blog.articles.businessApplication.signs.reporting.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessApplication.signs.growth.title',
    ),
    description: t(
      'blog.articles.businessApplication.signs.growth.description',
    ),
  },
])

const applicationModules = computed(() => [
  {
    title: t(
      'blog.articles.businessApplication.modules.customers.title',
    ),
    description: t(
      'blog.articles.businessApplication.modules.customers.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessApplication.modules.sales.title',
    ),
    description: t(
      'blog.articles.businessApplication.modules.sales.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessApplication.modules.inventory.title',
    ),
    description: t(
      'blog.articles.businessApplication.modules.inventory.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessApplication.modules.documents.title',
    ),
    description: t(
      'blog.articles.businessApplication.modules.documents.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessApplication.modules.tasks.title',
    ),
    description: t(
      'blog.articles.businessApplication.modules.tasks.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessApplication.modules.reports.title',
    ),
    description: t(
      'blog.articles.businessApplication.modules.reports.description',
    ),
  },
])

const startingSteps = computed(() => [
  {
    title: t(
      'blog.articles.businessApplication.steps.problem.title',
    ),
    description: t(
      'blog.articles.businessApplication.steps.problem.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessApplication.steps.process.title',
    ),
    description: t(
      'blog.articles.businessApplication.steps.process.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessApplication.steps.priority.title',
    ),
    description: t(
      'blog.articles.businessApplication.steps.priority.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessApplication.steps.prototype.title',
    ),
    description: t(
      'blog.articles.businessApplication.steps.prototype.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessApplication.steps.testing.title',
    ),
    description: t(
      'blog.articles.businessApplication.steps.testing.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessApplication.steps.development.title',
    ),
    description: t(
      'blog.articles.businessApplication.steps.development.description',
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
        {{ t('blog.articles.businessApplication.lead.first') }}
      </p>

      <p>
        {{ t('blog.articles.businessApplication.lead.second') }}
      </p>
    </ArticleSection>

   <!--  <ArticleImage
      src="/images/blog/business-application/hero.jpg"
      :alt="
        t('blog.articles.businessApplication.images.hero.alt')
      "
      :caption="
        t('blog.articles.businessApplication.images.hero.caption')
      "
    /> -->

    <!-- ================================================== -->
    <!-- 02. SAJT I APLIKACIJA                              -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.businessApplication.website.title')
      "
    >
      <p>
        {{ t('blog.articles.businessApplication.website.first') }}
      </p>

      <p>
        {{ t('blog.articles.businessApplication.website.second') }}
      </p>

      <p>
        {{ t('blog.articles.businessApplication.website.third') }}
      </p>
    </ArticleSection>

    <ArticleCallout
      type="info"
      :title="
        t('blog.articles.businessApplication.definition.title')
      "
    >
      <p>
        {{ t('blog.articles.businessApplication.definition.text') }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 03. EXCEL                                          -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.businessApplication.excel.title')
      "
    >
      <p>
        {{ t('blog.articles.businessApplication.excel.first') }}
      </p>

      <p>
        {{ t('blog.articles.businessApplication.excel.second') }}
      </p>

      <p>
        {{ t('blog.articles.businessApplication.excel.third') }}
      </p>
    </ArticleSection>

    <ArticleImage
      src="/images/blog/business-application/excel-vs-application.jpg"
      :alt="
        t(
          'blog.articles.businessApplication.images.excelVsApplication.alt',
        )
      "
      :caption="
        t(
          'blog.articles.businessApplication.images.excelVsApplication.caption',
        )
      "
    />

    <!-- ================================================== -->
    <!-- 04. ZNACI DA JE APLIKACIJA POTREBNA                -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.businessApplication.signs.title')
      "
    >
      <p>
        {{ t('blog.articles.businessApplication.signs.intro') }}
      </p>

      <ArticleChecklist :items="warningSigns" />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 05. GOTOV ILI PRILAGOĐEN SOFTVER                   -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.businessApplication.solution.title')
      "
    >
      <p>
        {{ t('blog.articles.businessApplication.solution.first') }}
      </p>

      <p>
        {{ t('blog.articles.businessApplication.solution.second') }}
      </p>

      <p>
        {{ t('blog.articles.businessApplication.solution.third') }}
      </p>
    </ArticleSection>

    <ArticleCallout
      type="warning"
      :title="
        t('blog.articles.businessApplication.warning.title')
      "
    >
      <p>
        {{ t('blog.articles.businessApplication.warning.text') }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 06. ŠTA APLIKACIJA MOŽE DA OBJEDINI                -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.businessApplication.modules.title')
      "
    >
      <p>
        {{ t('blog.articles.businessApplication.modules.intro') }}
      </p>

      <ArticleChecklist :items="applicationModules" />
    </ArticleSection>

    <ArticleImage
      src="/images/blog/business-application/business-process.jpg"
      :alt="
        t(
          'blog.articles.businessApplication.images.businessProcess.alt',
        )
      "
      :caption="
        t(
          'blog.articles.businessApplication.images.businessProcess.caption',
        )
      "
    />

    <!-- ================================================== -->
    <!-- 07. AUTOMATIZACIJA                                 -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.businessApplication.automation.title')
      "
    >
      <p>
        {{ t('blog.articles.businessApplication.automation.first') }}
      </p>

      <p>
        {{ t('blog.articles.businessApplication.automation.second') }}
      </p>

      <p>
        {{ t('blog.articles.businessApplication.automation.third') }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 08. KAKO POČETI                                    -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.businessApplication.steps.title')
      "
    >
      <p>
        {{ t('blog.articles.businessApplication.steps.intro') }}
      </p>

      <ArticleChecklist
        ordered
        :items="startingSteps"
      />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 09. EXPRESS WEB PREPORUKA                          -->
    <!-- ================================================== -->

    <ArticleCallout
      type="success"
      :title="
        t(
          'blog.articles.businessApplication.recommendation.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.businessApplication.recommendation.text',
          )
        }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 10. ZAKLJUČAK                                      -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.businessApplication.conclusion.title')
      "
    >
      <p>
        {{
          t(
            'blog.articles.businessApplication.conclusion.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.businessApplication.conclusion.second',
          )
        }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 11. CTA                                            -->
    <!-- ================================================== -->

    <ArticleCta
      :title="
        t('blog.articles.businessApplication.cta.title')
      "
      :description="
        t('blog.articles.businessApplication.cta.description')
      "
      :primary-text="
        t('blog.articles.businessApplication.cta.primary')
      "
      primary-link="/contact"
      :secondary-text="
        t('blog.articles.businessApplication.cta.secondary')
      "
      secondary-link="/projects"
    />
  </article>
</template>