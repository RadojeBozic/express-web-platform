<script setup>
import { useI18n } from 'vue-i18n'

import ArticleImage from '@/blog/components/ArticleImage.vue'
import ArticleSection from '@/blog/components/ArticleSection.vue'

const { t, tm } = useI18n()

const phases = tm(
  'blog.articles.digitalProject.phases.items',
)

const discoveryQuestions = tm(
  'blog.articles.digitalProject.discovery.questions',
)

const planningElements = tm(
  'blog.articles.digitalProject.planning.items',
)

const testingAreas = tm(
  'blog.articles.digitalProject.testing.items',
)

const mistakes = tm(
  'blog.articles.digitalProject.mistakes.items',
)

const successSignals = tm(
  'blog.articles.digitalProject.success.items',
)
</script>

<template>
  <div class="space-y-12">
    <!-- ================================================= -->
    <!-- UVOD                                             -->
    <!-- ================================================= -->

    <ArticleSection lead>
      <p>
        {{ t('blog.articles.digitalProject.lead.first') }}
      </p>

      <p>
        {{ t('blog.articles.digitalProject.lead.second') }}
      </p>
    </ArticleSection>

    <!-- Hero sliku prikazuje BlogPost.vue -->

    <!--
    <ArticleImage
      src="/images/blog/digital-project/hero.jpg"
      :alt="
        t(
          'blog.articles.digitalProject.images.hero.alt',
        )
      "
      :caption="
        t(
          'blog.articles.digitalProject.images.hero.caption',
        )
      "
    />
    -->

    <!-- ================================================= -->
    <!-- PROJEKAT NE POČINJE KODOM                        -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t(
          'blog.articles.digitalProject.principle.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.digitalProject.principle.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.digitalProject.principle.second',
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
              'blog.articles.digitalProject.principle.quote',
            )
          }}
        </p>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- FAZE PROJEKTA                                    -->
    <!-- ================================================= -->

    <ArticleImage
      src="/images/blog/digital-project/process.jpg"
      :alt="
        t(
          'blog.articles.digitalProject.images.process.alt',
        )
      "
      :caption="
        t(
          'blog.articles.digitalProject.images.process.caption',
        )
      "
    />

    <ArticleSection
      :title="
        t(
          'blog.articles.digitalProject.phases.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.digitalProject.phases.intro',
          )
        }}
      </p>

      <div class="mt-10 space-y-6">
        <section
          v-for="(phase, index) in phases"
          :key="phase.title"
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

            <div>
              <p
                class="text-sm font-semibold uppercase tracking-[0.14em] text-purple-300"
              >
                {{ phase.eyebrow }}
              </p>

              <h3
                class="mt-2 text-2xl font-bold text-white"
              >
                {{ phase.title }}
              </h3>

              <p
                class="mt-4 leading-8 text-slate-300"
              >
                {{ phase.description }}
              </p>

              <div
                class="mt-5 rounded-xl border border-slate-700 bg-slate-950/60 p-5"
              >
                <p
                  class="text-sm font-semibold text-slate-200"
                >
                  {{
                    t(
                      'blog.articles.digitalProject.phases.resultLabel',
                    )
                  }}
                </p>

                <p
                  class="mt-2 leading-7 text-slate-400"
                >
                  {{ phase.result }}
                </p>
              </div>
            </div>
          </div>
        </section>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- RAZUMEVANJE PROBLEMA                             -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t(
          'blog.articles.digitalProject.discovery.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.digitalProject.discovery.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.digitalProject.discovery.second',
          )
        }}
      </p>

      <div class="mt-8 grid gap-5 md:grid-cols-2">
        <div
          v-for="question in discoveryQuestions"
          :key="question"
          class="flex gap-3 rounded-xl border border-slate-800 bg-slate-900/60 p-5"
        >
          <span
            class="mt-1 text-purple-300"
            aria-hidden="true"
          >
            ?
          </span>

          <p class="leading-7 text-slate-300">
            {{ question }}
          </p>
        </div>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- ANALIZA POSLOVANJA                               -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t(
          'blog.articles.digitalProject.analysis.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.digitalProject.analysis.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.digitalProject.analysis.second',
          )
        }}
      </p>

      <div class="mt-8 grid gap-5 sm:grid-cols-2">
        <div
          class="rounded-2xl border border-slate-800 bg-slate-900/70 p-6"
        >
          <h3 class="text-lg font-semibold text-white">
            {{
              t(
                'blog.articles.digitalProject.analysis.technologyFirst.title',
              )
            }}
          </h3>

          <p class="mt-3 leading-7 text-slate-400">
            {{
              t(
                'blog.articles.digitalProject.analysis.technologyFirst.description',
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
                'blog.articles.digitalProject.analysis.businessFirst.title',
              )
            }}
          </h3>

          <p
            class="mt-3 leading-7 text-purple-100/80"
          >
            {{
              t(
                'blog.articles.digitalProject.analysis.businessFirst.description',
              )
            }}
          </p>
        </div>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- PLANIRANJE                                       -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t(
          'blog.articles.digitalProject.planning.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.digitalProject.planning.intro',
          )
        }}
      </p>

      <div
        class="mt-8 grid gap-5 md:grid-cols-2"
      >
        <div
          v-for="item in planningElements"
          :key="item.title"
          class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6"
        >
          <h3 class="font-semibold text-white">
            {{ item.title }}
          </h3>

          <p class="mt-3 leading-7 text-slate-400">
            {{ item.description }}
          </p>
        </div>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- RAZVOJ                                           -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t(
          'blog.articles.digitalProject.development.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.digitalProject.development.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.digitalProject.development.second',
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
              'blog.articles.digitalProject.development.warning',
            )
          }}
        </p>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- TESTIRANJE                                       -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t(
          'blog.articles.digitalProject.testing.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.digitalProject.testing.intro',
          )
        }}
      </p>

      <div
        class="mt-8 grid gap-5 md:grid-cols-2"
      >
        <div
          v-for="area in testingAreas"
          :key="area.title"
          class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6"
        >
          <h3 class="font-semibold text-white">
            {{ area.title }}
          </h3>

          <p class="mt-3 leading-7 text-slate-400">
            {{ area.description }}
          </p>
        </div>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- IMPLEMENTACIJA                                   -->
    <!-- ================================================= -->

    <ArticleImage
      src="/images/blog/digital-project/lifecycle.jpg"
      :alt="
        t(
          'blog.articles.digitalProject.images.lifecycle.alt',
        )
      "
      :caption="
        t(
          'blog.articles.digitalProject.images.lifecycle.caption',
        )
      "
    />

    <ArticleSection
      :title="
        t(
          'blog.articles.digitalProject.launch.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.digitalProject.launch.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.digitalProject.launch.second',
          )
        }}
      </p>

      <div
        class="mt-8 rounded-2xl border border-purple-500/30 bg-purple-500/10 p-6"
      >
        <p
          class="font-semibold leading-8 text-purple-100"
        >
          {{
            t(
              'blog.articles.digitalProject.launch.principle',
            )
          }}
        </p>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- PROJEKAT SE RAZVIJA                              -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t(
          'blog.articles.digitalProject.evolution.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.digitalProject.evolution.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.digitalProject.evolution.second',
          )
        }}
      </p>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- GREŠKE                                           -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t(
          'blog.articles.digitalProject.mistakes.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.digitalProject.mistakes.intro',
          )
        }}
      </p>

      <div class="mt-8 grid gap-5 md:grid-cols-2">
        <div
          v-for="mistake in mistakes"
          :key="mistake.title"
          class="rounded-2xl border border-red-500/20 bg-red-500/5 p-6"
        >
          <h3 class="font-semibold text-red-100">
            {{ mistake.title }}
          </h3>

          <p class="mt-3 leading-7 text-slate-400">
            {{ mistake.description }}
          </p>
        </div>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- KAKO PREPOZNATI USPEH                            -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t(
          'blog.articles.digitalProject.success.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.digitalProject.success.intro',
          )
        }}
      </p>

      <ul class="mt-8 space-y-4">
        <li
          v-for="item in successSignals"
          :key="item"
          class="flex gap-3 rounded-xl border border-slate-800 bg-slate-900/60 p-5"
        >
          <span
            class="mt-1 text-purple-300"
            aria-hidden="true"
          >
            ✓
          </span>

          <span class="leading-7 text-slate-300">
            {{ item }}
          </span>
        </li>
      </ul>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- ZAKLJUČAK                                        -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t(
          'blog.articles.digitalProject.conclusion.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.digitalProject.conclusion.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.digitalProject.conclusion.second',
          )
        }}
      </p>

      <div
        class="mt-8 rounded-2xl border border-purple-500/30 bg-gradient-to-br from-purple-500/15 to-indigo-500/5 p-6 sm:p-8"
      >
        <h3 class="text-xl font-semibold text-white">
          {{
            t(
              'blog.articles.digitalProject.cta.title',
            )
          }}
        </h3>

        <p class="mt-3 leading-7 text-slate-300">
          {{
            t(
              'blog.articles.digitalProject.cta.description',
            )
          }}
        </p>
      </div>
    </ArticleSection>
  </div>
</template>