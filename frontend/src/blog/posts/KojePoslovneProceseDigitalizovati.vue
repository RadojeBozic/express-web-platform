<script setup>
import { useI18n } from 'vue-i18n'

import ArticleImage from '@/blog/components/ArticleImage.vue'
import ArticleSection from '@/blog/components/ArticleSection.vue'

const { t, tm } = useI18n()

const recognitionSignals = tm(
  'blog.articles.businessProcesses.recognition.signals',
)

const industries = tm(
  'blog.articles.businessProcesses.industries.items',
)

const priorities = tm(
  'blog.articles.businessProcesses.priorities.items',
)

const implementationSteps = tm(
  'blog.articles.businessProcesses.implementation.steps',
)

const mistakes = tm(
  'blog.articles.businessProcesses.mistakes.items',
)

const checklist = tm(
  'blog.articles.businessProcesses.checklist.items',
)
</script>

<template>
  <div class="space-y-12">
    <!-- ================================================= -->
    <!-- UVOD                                             -->
    <!-- ================================================= -->

    <ArticleSection lead>
      <p>
        {{
          t(
            'blog.articles.businessProcesses.lead.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.businessProcesses.lead.second',
          )
        }}
      </p>
    </ArticleSection>

    <!-- Hero sliku prikazuje BlogPost.vue -->

    <!--
    <ArticleImage
      src="/images/blog/business-processes/hero.jpg"
      :alt="
        t(
          'blog.articles.businessProcesses.images.hero.alt',
        )
      "
      :caption="
        t(
          'blog.articles.businessProcesses.images.hero.caption',
        )
      "
    />
    -->

    <!-- ================================================= -->
    <!-- ŠTA JE DIGITALIZACIJA                            -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t(
          'blog.articles.businessProcesses.definition.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.businessProcesses.definition.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.businessProcesses.definition.second',
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
              'blog.articles.businessProcesses.definition.principle',
            )
          }}
        </p>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- POSTOJEĆI SISTEM                                 -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t(
          'blog.articles.businessProcesses.existingSystem.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.businessProcesses.existingSystem.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.businessProcesses.existingSystem.second',
          )
        }}
      </p>

      <div
        class="mt-8 grid gap-5 sm:grid-cols-2"
      >
        <div
          class="rounded-2xl border border-slate-800 bg-slate-900/70 p-6"
        >
          <h3 class="text-lg font-semibold text-white">
            {{
              t(
                'blog.articles.businessProcesses.existingSystem.fragmented.title',
              )
            }}
          </h3>

          <p class="mt-3 leading-7 text-slate-400">
            {{
              t(
                'blog.articles.businessProcesses.existingSystem.fragmented.description',
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
                'blog.articles.businessProcesses.existingSystem.connected.title',
              )
            }}
          </h3>

          <p
            class="mt-3 leading-7 text-purple-100/80"
          >
            {{
              t(
                'blog.articles.businessProcesses.existingSystem.connected.description',
              )
            }}
          </p>
        </div>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- PREPOZNAVANJE PROCESA                            -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t(
          'blog.articles.businessProcesses.recognition.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.businessProcesses.recognition.intro',
          )
        }}
      </p>

      <div
        class="mt-8 grid gap-5 md:grid-cols-2"
      >
        <div
          v-for="signal in recognitionSignals"
          :key="signal.title"
          class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6"
        >
          <h3 class="font-semibold text-white">
            {{ signal.title }}
          </h3>

          <p class="mt-3 leading-7 text-slate-400">
            {{ signal.description }}
          </p>
        </div>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- DELATNOSTI                                       -->
    <!-- ================================================= -->

    <ArticleImage
      src="/images/blog/business-processes/industries.jpg"
      :alt="
        t(
          'blog.articles.businessProcesses.images.industries.alt',
        )
      "
      :caption="
        t(
          'blog.articles.businessProcesses.images.industries.caption',
        )
      "
    />

    <ArticleSection
      :title="
        t(
          'blog.articles.businessProcesses.industries.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.businessProcesses.industries.intro',
          )
        }}
      </p>

      <div class="mt-10 grid gap-6 md:grid-cols-2">
        <section
          v-for="industry in industries"
          :key="industry.title"
          class="rounded-2xl border border-slate-800 bg-slate-900/70 p-6"
        >
          <div class="flex items-start gap-4">
            <span
              class="text-3xl"
              aria-hidden="true"
            >
              {{ industry.icon }}
            </span>

            <div>
              <h3
                class="text-xl font-semibold text-white"
              >
                {{ industry.title }}
              </h3>

              <p
                class="mt-3 leading-7 text-slate-400"
              >
                {{ industry.description }}
              </p>

              <div
                class="mt-5 rounded-xl border border-slate-700 bg-slate-950/60 p-5"
              >
                <p
                  class="text-sm font-semibold text-slate-200"
                >
                  {{
                    t(
                      'blog.articles.businessProcesses.industries.processesLabel',
                    )
                  }}
                </p>

                <p
                  class="mt-2 leading-7 text-slate-400"
                >
                  {{ industry.processes }}
                </p>
              </div>
            </div>
          </div>
        </section>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- ŠTA PRVO DIGITALIZOVATI                           -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t(
          'blog.articles.businessProcesses.priorities.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.businessProcesses.priorities.intro',
          )
        }}
      </p>

      <ol class="mt-8 space-y-5">
        <li
          v-for="(priority, index) in priorities"
          :key="priority.title"
          class="flex gap-4 rounded-2xl border border-slate-800 bg-slate-900/60 p-5"
        >
          <span
            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-purple-500 text-sm font-bold text-white"
          >
            {{ index + 1 }}
          </span>

          <div>
            <h3 class="font-semibold text-white">
              {{ priority.title }}
            </h3>

            <p class="mt-2 leading-7 text-slate-400">
              {{ priority.description }}
            </p>
          </div>
        </li>
      </ol>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- NE DIGITALIZOVATI SVE ODJEDNOM                   -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t(
          'blog.articles.businessProcesses.gradual.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.businessProcesses.gradual.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.businessProcesses.gradual.second',
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
              'blog.articles.businessProcesses.gradual.warning',
            )
          }}
        </p>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- PLAN UVOĐENJA                                    -->
    <!-- ================================================= -->

    <ArticleImage
      src="/images/blog/business-processes/roadmap.jpg"
      :alt="
        t(
          'blog.articles.businessProcesses.images.roadmap.alt',
        )
      "
      :caption="
        t(
          'blog.articles.businessProcesses.images.roadmap.caption',
        )
      "
    />

    <ArticleSection
      :title="
        t(
          'blog.articles.businessProcesses.implementation.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.businessProcesses.implementation.intro',
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
            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-purple-500/15 text-sm font-bold text-purple-300"
          >
            {{ index + 1 }}
          </span>

          <div>
            <h3 class="font-semibold text-white">
              {{ step.title }}
            </h3>

            <p class="mt-2 leading-7 text-slate-400">
              {{ step.description }}
            </p>
          </div>
        </li>
      </ol>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- GOTOV ILI PRILAGOĐEN SOFTVER                     -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t(
          'blog.articles.businessProcesses.solution.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.businessProcesses.solution.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.businessProcesses.solution.second',
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
                'blog.articles.businessProcesses.solution.standard.title',
              )
            }}
          </h3>

          <p class="mt-3 leading-7 text-slate-400">
            {{
              t(
                'blog.articles.businessProcesses.solution.standard.description',
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
                'blog.articles.businessProcesses.solution.custom.title',
              )
            }}
          </h3>

          <p
            class="mt-3 leading-7 text-purple-100/80"
          >
            {{
              t(
                'blog.articles.businessProcesses.solution.custom.description',
              )
            }}
          </p>
        </div>
      </div>
    </ArticleSection>

    <!-- ================================================= -->
    <!-- GREŠKE                                           -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t(
          'blog.articles.businessProcesses.mistakes.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.businessProcesses.mistakes.intro',
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
    <!-- KONTROLNA LISTA                                  -->
    <!-- ================================================= -->

    <ArticleSection
      :title="
        t(
          'blog.articles.businessProcesses.checklist.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.businessProcesses.checklist.intro',
          )
        }}
      </p>

      <ul class="mt-8 space-y-4">
        <li
          v-for="item in checklist"
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
          'blog.articles.businessProcesses.conclusion.title',
        )
      "
    >
      <p>
        {{
          t(
            'blog.articles.businessProcesses.conclusion.first',
          )
        }}
      </p>

      <p>
        {{
          t(
            'blog.articles.businessProcesses.conclusion.second',
          )
        }}
      </p>

      <div
        class="mt-8 rounded-2xl border border-purple-500/30 bg-gradient-to-br from-purple-500/15 to-indigo-500/5 p-6 sm:p-8"
      >
        <h3 class="text-xl font-semibold text-white">
          {{
            t(
              'blog.articles.businessProcesses.cta.title',
            )
          }}
        </h3>

        <p class="mt-3 leading-7 text-slate-300">
          {{
            t(
              'blog.articles.businessProcesses.cta.description',
            )
          }}
        </p>
      </div>
    </ArticleSection>
  </div>
</template>