<script setup>
import { computed } from 'vue'
import { useI18n } from 'vue-i18n'

import ArticleSection from '@/blog/components/ArticleSection.vue'
import ArticleCallout from '@/blog/components/ArticleCallout.vue'
import ArticleChecklist from '@/blog/components/ArticleChecklist.vue'
import ArticleCta from '@/blog/components/ArticleCta.vue'
import ArticleImage from '@/blog/components/ArticleImage.vue'

const { t } = useI18n()

const businessGoals = computed(() => [
  {
    title: t(
      'blog.articles.businessWebsite.goals.inquiries.title',
    ),
    description: t(
      'blog.articles.businessWebsite.goals.inquiries.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessWebsite.goals.sales.title',
    ),
    description: t(
      'blog.articles.businessWebsite.goals.sales.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessWebsite.goals.trust.title',
    ),
    description: t(
      'blog.articles.businessWebsite.goals.trust.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessWebsite.goals.information.title',
    ),
    description: t(
      'blog.articles.businessWebsite.goals.information.description',
    ),
  },
])

const essentialElements = computed(() => [
  {
    title: t(
      'blog.articles.businessWebsite.essentials.message.title',
    ),
    description: t(
      'blog.articles.businessWebsite.essentials.message.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessWebsite.essentials.mobile.title',
    ),
    description: t(
      'blog.articles.businessWebsite.essentials.mobile.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessWebsite.essentials.speed.title',
    ),
    description: t(
      'blog.articles.businessWebsite.essentials.speed.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessWebsite.essentials.contact.title',
    ),
    description: t(
      'blog.articles.businessWebsite.essentials.contact.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessWebsite.essentials.seo.title',
    ),
    description: t(
      'blog.articles.businessWebsite.essentials.seo.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessWebsite.essentials.security.title',
    ),
    description: t(
      'blog.articles.businessWebsite.essentials.security.description',
    ),
  },
])

const selectionSteps = computed(() => [
  {
    title: t(
      'blog.articles.businessWebsite.steps.goal.title',
    ),
    description: t(
      'blog.articles.businessWebsite.steps.goal.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessWebsite.steps.content.title',
    ),
    description: t(
      'blog.articles.businessWebsite.steps.content.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessWebsite.steps.scope.title',
    ),
    description: t(
      'blog.articles.businessWebsite.steps.scope.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessWebsite.steps.partner.title',
    ),
    description: t(
      'blog.articles.businessWebsite.steps.partner.description',
    ),
  },
  {
    title: t(
      'blog.articles.businessWebsite.steps.growth.title',
    ),
    description: t(
      'blog.articles.businessWebsite.steps.growth.description',
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
        {{ t('blog.articles.businessWebsite.lead.first') }}
      </p>

      <p>
        {{ t('blog.articles.businessWebsite.lead.second') }}
      </p>
    </ArticleSection>

    <!-- Glavna ilustracija unutar članka -->
    <!-- <ArticleImage
      src="/images/blog/business-website/hero.jpg"
      :alt="
        t('blog.articles.businessWebsite.images.hero.alt')
      "
      :caption="
        t(
          'blog.articles.businessWebsite.images.hero.caption',
        )
      "
    /> -->

    <!-- ================================================== -->
    <!-- 02. POSLOVNI CILJ                                  -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.businessWebsite.goal.title')"
    >
      <p>
        {{ t('blog.articles.businessWebsite.goal.first') }}
      </p>

      <p>
        {{ t('blog.articles.businessWebsite.goal.second') }}
      </p>

      <ArticleChecklist :items="businessGoals" />
    </ArticleSection>

    <ArticleImage
      src="/images/blog/business-website/goals.jpg"
      :alt="
        t('blog.articles.businessWebsite.images.goals.alt')
      "
      :caption="
        t(
          'blog.articles.businessWebsite.images.goals.caption',
        )
      "
    />

    <!-- ================================================== -->
    <!-- 03. ČESTA GREŠKA                                   -->
    <!-- ================================================== -->

    <ArticleCallout
      type="warning"
      :title="
        t('blog.articles.businessWebsite.warning.title')
      "
    >
      <p>
        {{ t('blog.articles.businessWebsite.warning.text') }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 04. CILJNA PUBLIKA                                 -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.businessWebsite.audience.title')
      "
    >
      <p>
        {{ t('blog.articles.businessWebsite.audience.first') }}
      </p>

      <p>
        {{
          t('blog.articles.businessWebsite.audience.second')
        }}
      </p>

      <p>
        {{ t('blog.articles.businessWebsite.audience.third') }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 05. OSNOVNI ELEMENTI POSLOVNOG SAJTA                -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.businessWebsite.essentials.title')
      "
    >
      <p>
        {{
          t(
            'blog.articles.businessWebsite.essentials.intro',
          )
        }}
      </p>

      <ArticleChecklist :items="essentialElements" />
    </ArticleSection>

    <ArticleImage
      src="/images/blog/business-website/checklist.jpg"
      :alt="
        t(
          'blog.articles.businessWebsite.images.checklist.alt',
        )
      "
      :caption="
        t(
          'blog.articles.businessWebsite.images.checklist.caption',
        )
      "
    />

    <!-- ================================================== -->
    <!-- 06. VAŽNA PREPORUKA                                -->
    <!-- ================================================== -->

    <ArticleCallout
      type="info"
      :title="
        t('blog.articles.businessWebsite.callout.title')
      "
    >
      <p>
        {{ t('blog.articles.businessWebsite.callout.text') }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 07. DIZAJN                                         -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.businessWebsite.design.title')
      "
    >
      <p>
        {{ t('blog.articles.businessWebsite.design.first') }}
      </p>

      <p>
        {{ t('blog.articles.businessWebsite.design.second') }}
      </p>

      <p>
        {{ t('blog.articles.businessWebsite.design.third') }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 08. CENA I VREDNOST                                -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.businessWebsite.price.title')
      "
    >
      <p>
        {{ t('blog.articles.businessWebsite.price.first') }}
      </p>

      <p>
        {{ t('blog.articles.businessWebsite.price.second') }}
      </p>

      <p>
        {{ t('blog.articles.businessWebsite.price.third') }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 09. PRAKTIČNI KORACI                               -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.businessWebsite.steps.title')
      "
    >
      <p>
        {{ t('blog.articles.businessWebsite.steps.intro') }}
      </p>

      <ArticleChecklist
        ordered
        :items="selectionSteps"
      />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 10. EXPRESS WEB PREPORUKA                           -->
    <!-- ================================================== -->

    <ArticleCallout
      type="success"
      :title="
        t(
          'blog.articles.businessWebsite.recommendation.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.businessWebsite.recommendation.text',
          )
        }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 11. ZAKLJUČAK                                      -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.businessWebsite.conclusion.title')
      "
    >
      <p>
        {{
          t(
            'blog.articles.businessWebsite.conclusion.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.businessWebsite.conclusion.second',
          )
        }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 12. POZIV NA AKCIJU                                -->
    <!-- ================================================== -->

    <ArticleCta
      :title="
        t('blog.articles.businessWebsite.cta.title')
      "
      :description="
        t('blog.articles.businessWebsite.cta.description')
      "
      :primary-text="
        t('blog.articles.businessWebsite.cta.primary')
      "
      primary-link="/contact"
      :secondary-text="
        t('blog.articles.businessWebsite.cta.secondary')
      "
      secondary-link="/projects"
    />
  </article>
</template>