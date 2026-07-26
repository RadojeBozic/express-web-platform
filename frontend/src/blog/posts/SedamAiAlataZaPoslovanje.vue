<script setup>
import { useI18n } from 'vue-i18n'

import ArticleImage from '@/blog/components/ArticleImage.vue'
import ArticleSection from '@/blog/components/ArticleSection.vue'

const { t, tm } = useI18n()

const tools = tm('blog.articles.aiTools.tools.items')
const selectionCriteria = tm(
  'blog.articles.aiTools.selection.criteria',
)
const implementationSteps = tm(
  'blog.articles.aiTools.implementation.steps',
)
const mistakes = tm(
  'blog.articles.aiTools.mistakes.items',
)
</script>

<template>
  <div class="space-y-12">
    <!-- ================================================= -->
    <!-- UVOD                                             -->
    <!-- ================================================= -->

    <ArticleSection lead>
      <p>
        {{ t('blog.articles.aiTools.lead.first') }}
      </p>

      <p>
        {{ t('blog.articles.aiTools.lead.second') }}
      </p>
    </ArticleSection>

    <!-- Hero sliku prikazuje BlogPost.vue -->

    <!--
    <ArticleImage
      src="/images/blog/ai-tools/hero.jpg"
      :alt="t('blog.articles.aiTools.images.hero.alt')"
      :caption="
        t('blog.articles.aiTools.images.hero.caption')
      "
    />
    -->

    <!-- ================================================= -->
    <!-- AI NIJE CILJ SAM PO SEBI                          -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t('blog.articles.aiTools.introduction.title')
      "
    >
      <p>
        {{
          t(
            'blog.articles.aiTools.introduction.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.aiTools.introduction.second',
          )
        }}
      </p>

      <div
        class="mt-8 rounded-2xl border border-purple-500/30 bg-purple-500/10 p-6"
      >
        <p
          class="text-lg font-semibold leading-8 text-purple-100"
        >
          {{
            t(
              'blog.articles.aiTools.introduction.principle',
            )
          }}
        </p>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- SEDAM ALATA                                      -->
    <!-- ================================================= -->

    <ArticleSection
      :title="t('blog.articles.aiTools.tools.title')"
    >
      <p>
        {{ t('blog.articles.aiTools.tools.intro') }}
      </p>

      <div class="mt-10 space-y-6">
        <section
          v-for="(tool, index) in tools"
          :key="tool.name"
          class="rounded-2xl border border-slate-800 bg-slate-900/70 p-6 sm:p-8"
        >
          <div
            class="flex flex-col gap-5 sm:flex-row sm:items-start"
          >
            <div
              class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-purple-500/15 text-lg font-bold text-purple-300"
              aria-hidden="true"
            >
              {{ index + 1 }}
            </div>

            <div class="min-w-0">
              <p
                class="text-sm font-semibold uppercase tracking-[0.14em] text-purple-300"
              >
                {{ tool.category }}
              </p>

              <h3
                class="mt-2 text-2xl font-bold text-white"
              >
                {{ tool.name }}
              </h3>

              <p
                class="mt-4 leading-8 text-slate-300"
              >
                {{ tool.description }}
              </p>

              <div
                class="mt-5 rounded-xl border border-slate-700 bg-slate-950/60 p-5"
              >
                <p
                  class="text-sm font-semibold text-slate-200"
                >
                  {{
                    t(
                      'blog.articles.aiTools.tools.businessUseLabel',
                    )
                  }}
                </p>

                <p
                  class="mt-2 leading-7 text-slate-400"
                >
                  {{ tool.businessUse }}
                </p>
              </div>

              <p
                class="mt-5 text-sm leading-6 text-slate-400"
              >
                <strong class="text-slate-200">
                  {{
                    t(
                      'blog.articles.aiTools.tools.bestForLabel',
                    )
                  }}
                </strong>

                {{ tool.bestFor }}
              </p>
            </div>
          </div>
        </section>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- RADNI PROCES                                     -->
    <!-- ================================================= -->

    <ArticleImage
      src="/images/blog/ai-tools/workflow.jpg"
      :alt="t('blog.articles.aiTools.images.workflow.alt')"
      :caption="
        t('blog.articles.aiTools.images.workflow.caption')
      "
    />

    <ArticleSection
      :title="
        t('blog.articles.aiTools.workflow.title')
      "
    >
      <p>
        {{ t('blog.articles.aiTools.workflow.first') }}
      </p>

      <p>
        {{ t('blog.articles.aiTools.workflow.second') }}
      </p>

      <div
        class="mt-8 grid gap-5 sm:grid-cols-2"
      >
        <div
          class="rounded-2xl border border-slate-800 bg-slate-900/70 p-6"
        >
          <h3
            class="text-lg font-semibold text-white"
          >
            {{
              t(
                'blog.articles.aiTools.workflow.withoutSystem.title',
              )
            }}
          </h3>

          <p
            class="mt-3 leading-7 text-slate-400"
          >
            {{
              t(
                'blog.articles.aiTools.workflow.withoutSystem.description',
              )
            }}
          </p>
        </div>

        <div
          class="rounded-2xl border border-purple-500/30 bg-purple-500/10 p-6"
        >
          <h3
            class="text-lg font-semibold text-purple-100"
          >
            {{
              t(
                'blog.articles.aiTools.workflow.withSystem.title',
              )
            }}
          </h3>

          <p
            class="mt-3 leading-7 text-purple-100/80"
          >
            {{
              t(
                'blog.articles.aiTools.workflow.withSystem.description',
              )
            }}
          </p>
        </div>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- IZBOR ALATA                                      -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t('blog.articles.aiTools.selection.title')
      "
    >
      <p>
        {{ t('blog.articles.aiTools.selection.intro') }}
      </p>

      <ul class="mt-7 space-y-4">
        <li
          v-for="criterion in selectionCriteria"
          :key="criterion.title"
          class="rounded-xl border border-slate-800 bg-slate-900/60 p-5"
        >
          <h3 class="font-semibold text-white">
            {{ criterion.title }}
          </h3>

          <p
            class="mt-2 leading-7 text-slate-400"
          >
            {{ criterion.description }}
          </p>
        </li>
      </ul>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- UVOĐENJE AI ALATA                                -->
    <!-- ================================================= -->

    <ArticleImage
      src="/images/blog/ai-tools/implementation.jpg"
      :alt="
        t(
          'blog.articles.aiTools.images.implementation.alt',
        )
      "
      :caption="
        t(
          'blog.articles.aiTools.images.implementation.caption',
        )
      "
    />

    <ArticleSection
      :title="
        t('blog.articles.aiTools.implementation.title')
      "
    >
      <p>
        {{
          t(
            'blog.articles.aiTools.implementation.intro',
          )
        }}
      </p>

      <ol class="mt-8 space-y-5">
        <li
          v-for="(step, index) in implementationSteps"
          :key="step.title"
          class="flex gap-4 rounded-2xl border border-slate-800 bg-slate-900/60 p-5"
        >
          <span
            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-purple-500 text-sm font-bold text-white"
          >
            {{ index + 1 }}
          </span>

          <div>
            <h3 class="font-semibold text-white">
              {{ step.title }}
            </h3>

            <p
              class="mt-2 leading-7 text-slate-400"
            >
              {{ step.description }}
            </p>
          </div>
        </li>
      </ol>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- GREŠKE                                           -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t('blog.articles.aiTools.mistakes.title')
      "
    >
      <p>
        {{ t('blog.articles.aiTools.mistakes.intro') }}
      </p>

      <div class="mt-8 grid gap-5 md:grid-cols-2">
        <div
          v-for="mistake in mistakes"
          :key="mistake.title"
          class="rounded-2xl border border-red-500/20 bg-red-500/5 p-6"
        >
          <h3
            class="font-semibold text-red-100"
          >
            {{ mistake.title }}
          </h3>

          <p
            class="mt-3 leading-7 text-slate-400"
          >
            {{ mistake.description }}
          </p>
        </div>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- BEZBEDNOST I ODGOVORNOST                          -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t('blog.articles.aiTools.responsibility.title')
      "
    >
      <p>
        {{
          t(
            'blog.articles.aiTools.responsibility.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.aiTools.responsibility.second',
          )
        }}
      </p>

      <div
        class="mt-8 rounded-2xl border border-amber-500/30 bg-amber-500/10 p-6"
      >
        <p
          class="font-semibold leading-8 text-amber-100"
        >
          {{
            t(
              'blog.articles.aiTools.responsibility.warning',
            )
          }}
        </p>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- ZAKLJUČAK                                        -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t('blog.articles.aiTools.conclusion.title')
      "
    >
      <p>
        {{
          t(
            'blog.articles.aiTools.conclusion.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.aiTools.conclusion.second',
          )
        }}
      </p>

      <div
        class="mt-8 rounded-2xl border border-purple-500/30 bg-gradient-to-br from-purple-500/15 to-indigo-500/5 p-6 sm:p-8"
      >
        <h3
          class="text-xl font-semibold text-white"
        >
          {{
            t(
              'blog.articles.aiTools.cta.title',
            )
          }}
        </h3>

        <p
          class="mt-3 leading-7 text-slate-300"
        >
          {{
            t(
              'blog.articles.aiTools.cta.description',
            )
          }}
        </p>
      </div>
    </ArticleSection>
  </div>
</template>