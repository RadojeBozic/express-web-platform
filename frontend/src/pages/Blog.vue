<script setup>
import { computed, ref } from 'vue'
import { useI18n } from 'vue-i18n'

import Header from '@/partials/Header.vue'
import Footer from '@/partials/Footer.vue'
import BlogCard from '@/blog/components/BlogCard.vue'

import {
  getPosts,
  getCategories,
  getCategoryBySlug,
  getAuthorBySlug,
} from '@/blog/services/blogService'

const { t } = useI18n()

const posts = getPosts()
const categories = getCategories()

const selectedCategory = ref('all')

const filteredPosts = computed(() => {
  if (selectedCategory.value === 'all') {
    return posts
  }

  return posts.filter(
    (post) => post.category === selectedCategory.value,
  )
})

const getPostCategory = (post) =>
  getCategoryBySlug(post.category)

const getPostAuthor = (post) =>
  getAuthorBySlug(post.author)

const getCategoryName = (category) =>
  t(`blog.categories.${category.slug}.name`)

const getCategoryDescription = (category) =>
  t(`blog.categories.${category.slug}.description`)
</script>

<template>
  <div class="flex min-h-screen flex-col bg-slate-950 text-white">
    <Header />

    <main class="grow">
      <section
        class="relative overflow-hidden border-b border-slate-800"
      >
        <div
          class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(124,58,237,0.18),transparent_38%)]"
          aria-hidden="true"
        />

        <div
          class="relative mx-auto max-w-7xl px-6 py-24 lg:px-8 lg:py-32"
        >
          <div class="max-w-3xl">
            <p
              class="mb-4 text-sm font-semibold uppercase tracking-[0.2em] text-purple-300"
            >
              {{ t('blog.hero.eyebrow') }}
            </p>

            <h1
              class="text-4xl font-bold tracking-tight sm:text-5xl lg:text-6xl"
            >
              {{ t('blog.hero.title') }}
            </h1>

            <p
              class="mt-6 max-w-2xl text-lg leading-8 text-slate-300"
            >
              {{ t('blog.hero.description') }}
            </p>
          </div>
        </div>
      </section>

      <section class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
        <div
          class="mb-12 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between"
        >
          <div>
            <p class="text-sm font-semibold text-purple-300">
              {{ t('blog.list.eyebrow') }}
            </p>

            <h2 class="mt-2 text-3xl font-bold tracking-tight">
              {{ t('blog.list.title') }}
            </h2>

            <p class="mt-3 max-w-2xl text-slate-400">
              {{ t('blog.list.description') }}
            </p>
          </div>

          <div
            class="flex flex-wrap gap-2"
            :aria-label="t('blog.filters.ariaLabel')"
          >
            <button
              type="button"
              class="rounded-full border px-4 py-2 text-sm font-medium transition"
              :class="
                selectedCategory === 'all'
                  ? 'border-purple-400 bg-purple-500 text-white'
                  : 'border-slate-700 bg-slate-900 text-slate-300 hover:border-purple-500/50 hover:text-white'
              "
              @click="selectedCategory = 'all'"
            >
              {{ t('blog.filters.all') }}
            </button>

            <button
              v-for="category in categories"
              :key="category.id"
              type="button"
              class="rounded-full border px-4 py-2 text-sm font-medium transition"
              :class="
                selectedCategory === category.slug
                  ? 'border-purple-400 bg-purple-500 text-white'
                  : 'border-slate-700 bg-slate-900 text-slate-300 hover:border-purple-500/50 hover:text-white'
              "
              :title="getCategoryDescription(category)"
              @click="selectedCategory = category.slug"
            >
              {{ getCategoryName(category) }}
            </button>
          </div>
        </div>

        <div
          v-if="filteredPosts.length"
          class="grid gap-8 md:grid-cols-2 xl:grid-cols-3"
        >
          <BlogCard
            v-for="post in filteredPosts"
            :key="post.id"
            :post="post"
            :category="getPostCategory(post)"
            :author="getPostAuthor(post)"
          />
        </div>

        <div
          v-else
          class="rounded-2xl border border-dashed border-slate-700 bg-slate-900/50 px-6 py-16 text-center"
        >
          <h3 class="text-xl font-semibold">
            {{ t('blog.empty.title') }}
          </h3>

          <p class="mt-3 text-slate-400">
            {{ t('blog.empty.description') }}
          </p>

          <button
            type="button"
            class="mt-6 rounded-full bg-purple-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-purple-500"
            @click="selectedCategory = 'all'"
          >
            {{ t('blog.empty.button') }}
          </button>
        </div>
      </section>
    </main>

    <Footer />
  </div>
</template>