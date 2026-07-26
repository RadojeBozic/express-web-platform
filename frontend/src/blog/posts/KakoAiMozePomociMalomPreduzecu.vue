<script setup>
import { computed } from 'vue'
import { useI18n } from 'vue-i18n'

import ArticleSection from '@/blog/components/ArticleSection.vue'
import ArticleCallout from '@/blog/components/ArticleCallout.vue'
import ArticleChecklist from '@/blog/components/ArticleChecklist.vue'
import ArticleImage from '@/blog/components/ArticleImage.vue'
import ArticleCta from '@/blog/components/ArticleCta.vue'

const { t } = useI18n()

const practicalUses = computed(() => [
  {
    title: t(
      'blog.articles.aiBusiness.uses.marketing.title',
    ),
    description: t(
      'blog.articles.aiBusiness.uses.marketing.description',
    ),
  },
  {
    title: t(
      'blog.articles.aiBusiness.uses.sales.title',
    ),
    description: t(
      'blog.articles.aiBusiness.uses.sales.description',
    ),
  },
  {
    title: t(
      'blog.articles.aiBusiness.uses.administration.title',
    ),
    description: t(
      'blog.articles.aiBusiness.uses.administration.description',
    ),
  },
  {
    title: t(
      'blog.articles.aiBusiness.uses.analytics.title',
    ),
    description: t(
      'blog.articles.aiBusiness.uses.analytics.description',
    ),
  },
  {
    title: t(
      'blog.articles.aiBusiness.uses.education.title',
    ),
    description: t(
      'blog.articles.aiBusiness.uses.education.description',
    ),
  },
])

const limitations = computed(() => [
  {
    title: t(
      'blog.articles.aiBusiness.limitations.context.title',
    ),
    description: t(
      'blog.articles.aiBusiness.limitations.context.description',
    ),
  },
  {
    title: t(
      'blog.articles.aiBusiness.limitations.responsibility.title',
    ),
    description: t(
      'blog.articles.aiBusiness.limitations.responsibility.description',
    ),
  },
  {
    title: t(
      'blog.articles.aiBusiness.limitations.experience.title',
    ),
    description: t(
      'blog.articles.aiBusiness.limitations.experience.description',
    ),
  },
  {
    title: t(
      'blog.articles.aiBusiness.limitations.accuracy.title',
    ),
    description: t(
      'blog.articles.aiBusiness.limitations.accuracy.description',
    ),
  },
  {
    title: t(
      'blog.articles.aiBusiness.limitations.relationships.title',
    ),
    description: t(
      'blog.articles.aiBusiness.limitations.relationships.description',
    ),
  },
])

const startingSteps = computed(() => [
  {
    title: t(
      'blog.articles.aiBusiness.steps.task.title',
    ),
    description: t(
      'blog.articles.aiBusiness.steps.task.description',
    ),
  },
  {
    title: t(
      'blog.articles.aiBusiness.steps.tool.title',
    ),
    description: t(
      'blog.articles.aiBusiness.steps.tool.description',
    ),
  },
  {
    title: t(
      'blog.articles.aiBusiness.steps.instructions.title',
    ),
    description: t(
      'blog.articles.aiBusiness.steps.instructions.description',
    ),
  },
  {
    title: t(
      'blog.articles.aiBusiness.steps.review.title',
    ),
    description: t(
      'blog.articles.aiBusiness.steps.review.description',
    ),
  },
  {
    title: t(
      'blog.articles.aiBusiness.steps.measure.title',
    ),
    description: t(
      'blog.articles.aiBusiness.steps.measure.description',
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
        {{ t('blog.articles.aiBusiness.lead.first') }}
      </p>

      <p>
        {{ t('blog.articles.aiBusiness.lead.second') }}
      </p>
    </ArticleSection>

    <!-- <ArticleImage
      src="/images/blog/ai-small-business/hero.jpg"
      :alt="t('blog.articles.aiBusiness.images.hero.alt')"
      :caption="
        t('blog.articles.aiBusiness.images.hero.caption')
      "
    /> -->

    <!-- ================================================== -->
    <!-- 02. ŠTA AI JESTE                                   -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.aiBusiness.definition.title')"
    >
      <p>
        {{ t('blog.articles.aiBusiness.definition.first') }}
      </p>

      <p>
        {{ t('blog.articles.aiBusiness.definition.second') }}
      </p>

      <p>
        {{ t('blog.articles.aiBusiness.definition.third') }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 03. NAJVEĆA ZABLUDA                                -->
    <!-- ================================================== -->

    <ArticleCallout
      type="warning"
      :title="t('blog.articles.aiBusiness.warning.title')"
    >
      <p>
        {{ t('blog.articles.aiBusiness.warning.text') }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 04. PRAKTIČNE PRIMENE                              -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.aiBusiness.uses.title')"
    >
      <p>
        {{ t('blog.articles.aiBusiness.uses.intro') }}
      </p>

      <ArticleChecklist :items="practicalUses" />
    </ArticleSection>

    <ArticleImage
      src="/images/blog/ai-small-business/marketing.jpg"
      :alt="
        t('blog.articles.aiBusiness.images.marketing.alt')
      "
      :caption="
        t('blog.articles.aiBusiness.images.marketing.caption')
      "
    />

    <!-- ================================================== -->
    <!-- 05. AI U SVAKODNEVNOM RADU                         -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.aiBusiness.dailyWork.title')"
    >
      <p>
        {{ t('blog.articles.aiBusiness.dailyWork.first') }}
      </p>

      <p>
        {{ t('blog.articles.aiBusiness.dailyWork.second') }}
      </p>

      <p>
        {{ t('blog.articles.aiBusiness.dailyWork.third') }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 06. VAŽAN PRINCIP                                  -->
    <!-- ================================================== -->

    <ArticleCallout
      type="info"
      :title="t('blog.articles.aiBusiness.callout.title')"
    >
      <p>
        {{ t('blog.articles.aiBusiness.callout.text') }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 07. ŠTA AI NE MOŽE                                 -->
    <!-- ================================================== -->

    <ArticleSection
      :title="
        t('blog.articles.aiBusiness.limitations.title')
      "
    >
      <p>
        {{
          t('blog.articles.aiBusiness.limitations.intro')
        }}
      </p>

      <ArticleChecklist :items="limitations" />
    </ArticleSection>

    <ArticleImage
      src="/images/blog/ai-small-business/assistant.jpg"
      :alt="
        t('blog.articles.aiBusiness.images.assistant.alt')
      "
      :caption="
        t('blog.articles.aiBusiness.images.assistant.caption')
      "
    />

    <!-- ================================================== -->
    <!-- 08. KAKO POČETI                                    -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.aiBusiness.steps.title')"
    >
      <p>
        {{ t('blog.articles.aiBusiness.steps.intro') }}
      </p>

      <ArticleChecklist
        ordered
        :items="startingSteps"
      />
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 09. BEZBEDNOST I PODACI                            -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.aiBusiness.security.title')"
    >
      <p>
        {{ t('blog.articles.aiBusiness.security.first') }}
      </p>

      <p>
        {{ t('blog.articles.aiBusiness.security.second') }}
      </p>

      <p>
        {{ t('blog.articles.aiBusiness.security.third') }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 10. EXPRESS WEB PREPORUKA                          -->
    <!-- ================================================== -->

    <ArticleCallout
      type="success"
      :title="
        t('blog.articles.aiBusiness.recommendation.title')
      "
    >
      <p>
        {{
          t('blog.articles.aiBusiness.recommendation.text')
        }}
      </p>
    </ArticleCallout>

    <!-- ================================================== -->
    <!-- 11. ZAKLJUČAK                                      -->
    <!-- ================================================== -->

    <ArticleSection
      :title="t('blog.articles.aiBusiness.conclusion.title')"
    >
      <p>
        {{ t('blog.articles.aiBusiness.conclusion.first') }}
      </p>

      <p>
        {{ t('blog.articles.aiBusiness.conclusion.second') }}
      </p>
    </ArticleSection>

    <!-- ================================================== -->
    <!-- 12. CTA                                            -->
    <!-- ================================================== -->

    <ArticleCta
      :title="t('blog.articles.aiBusiness.cta.title')"
      :description="
        t('blog.articles.aiBusiness.cta.description')
      "
      :primary-text="
        t('blog.articles.aiBusiness.cta.primary')
      "
      primary-link="/contact"
      :secondary-text="
        t('blog.articles.aiBusiness.cta.secondary')
      "
      secondary-link="/services/ai-automation"
    />
  </article>
</template>