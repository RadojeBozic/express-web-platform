<script setup>
import { computed } from 'vue'
import { RouterLink } from 'vue-router'
import { useI18n } from 'vue-i18n'

const props = defineProps({
  post: {
    type: Object,
    required: true,
  },

  category: {
    type: Object,
    default: null,
  },

  author: {
    type: Object,
    default: null,
  },
})

const { t, locale, te } = useI18n()

// ========================================================
// LOKALIZACIJA
// ========================================================

const translateOrFallback = (key, fallback = '') => {
  if (!key) {
    return fallback
  }

  return te(key) ? t(key) : fallback
}

const dateLocale = computed(() => {
  const localeMap = {
    sr: 'sr-RS',
    en: 'en-GB',
    de: 'de-DE',
  }

  return localeMap[locale.value] || 'sr-RS'
})


// ========================================================
// PODACI ČLANKA
// ========================================================

const postTitle = computed(() =>
  translateOrFallback(
    props.post?.titleKey,
    props.post?.title || '',
  ),
)

const postExcerpt = computed(() =>
  translateOrFallback(
    props.post?.excerptKey,
    props.post?.excerpt || '',
  ),
)

const postImageAlt = computed(() =>
  translateOrFallback(
    props.post?.cardImageAltKey ||
      props.post?.imageAltKey,
    props.post?.cardImageAlt ||
      props.post?.imageAlt ||
      postTitle.value,
  ),
)

const postUrl = computed(() =>
  `/blog/${props.post.slug}`,
)

// ========================================================
// KATEGORIJA
// ========================================================

const categoryName = computed(() => {
  if (!props.category?.slug) {
    return ''
  }

  const key =
    `blog.categories.${props.category.slug}.name`

  return translateOrFallback(
    key,
    props.category.name || '',
  )
})

// ========================================================
// AUTOR
// ========================================================

const authorRole = computed(() => {
  if (!props.author) {
    return ''
  }

  return props.author.roleKey
    ? t(props.author.roleKey)
    : props.author.role || ''
})

// ========================================================
// DATUM
// ========================================================

const formattedDate = computed(() => {
  if (!props.post?.publishedAt) {
    return ''
  }

  const date = new Date(props.post.publishedAt)

  if (Number.isNaN(date.getTime())) {
    return ''
  }

  return new Intl.DateTimeFormat(dateLocale.value, {
    day: '2-digit',
    month: 'long',
    year: 'numeric',
  }).format(date)
})

// ========================================================
// PRISTUPAČNOST
// ========================================================

const readArticleAriaLabel = computed(() =>
  t('blog.card.readArticleAria', {
    title: postTitle.value,
  }),
)
</script>

<template>
  <article
    class="group flex h-full flex-col overflow-hidden rounded-2xl border border-slate-800 bg-slate-900/70 shadow-lg transition duration-300 hover:-translate-y-1 hover:border-purple-500/50 hover:shadow-purple-950/30"
  >
    <!-- ================================================== -->
    <!-- NASLOVNA SLIKA                                     -->
    <!-- ================================================== -->

    <RouterLink
      :to="postUrl"
      class="block overflow-hidden bg-white"
      :aria-label="readArticleAriaLabel"
    >
      <img
        :src="post.cardImage || post.image"
        :alt="postImageAlt"
        class="aspect-[3/2] w-full object-contain object-center transition duration-500 group-hover:scale-[1.02]"
        loading="lazy"
      />
    </RouterLink>

    <!-- ================================================== -->
    <!-- SADRŽAJ KARTICE                                    -->
    <!-- ================================================== -->

    <div class="flex grow flex-col p-6">
      <!-- Meta podaci -->

      <div
        class="mb-4 flex flex-wrap items-center gap-3 text-sm text-slate-400"
      >
        <span
          v-if="categoryName"
          class="rounded-full border border-purple-500/30 bg-purple-500/10 px-3 py-1 text-purple-300"
        >
          {{ categoryName }}
        </span>

        <time
          v-if="formattedDate"
          :datetime="post.publishedAt"
        >
          {{ formattedDate }}
        </time>

        <span v-if="post.readingTime">
          {{
            t('blog.card.readingTime', {
              minutes: post.readingTime,
            })
          }}
        </span>
      </div>

      <!-- Naslov -->

      <h2
        class="mb-3 text-2xl font-semibold leading-tight text-white"
      >
        <RouterLink
          :to="postUrl"
          class="transition hover:text-purple-300"
        >
          {{ postTitle }}
        </RouterLink>
      </h2>

      <!-- Kratak opis -->

      <p class="mb-6 leading-7 text-slate-300">
        {{ postExcerpt }}
      </p>

      <!-- Autor i link -->

      <div
        class="mt-auto flex items-center justify-between gap-4"
      >
        <div
          v-if="author"
          class="flex min-w-0 items-center gap-3"
        >
          <img
            v-if="author.image"
            :src="author.image"
            :alt="author.name"
            class="h-10 w-10 shrink-0 rounded-full object-cover ring-1 ring-purple-500/30"
            loading="lazy"
          />

          <div class="min-w-0">
            <p
              class="truncate text-sm font-medium text-white"
            >
              {{ author.name }}
            </p>

            <p
              v-if="authorRole"
              class="truncate text-xs text-slate-400"
            >
              {{ authorRole }}
            </p>
          </div>
        </div>

        <RouterLink
          :to="postUrl"
          class="inline-flex shrink-0 items-center gap-1 text-sm font-semibold text-purple-300 transition hover:text-purple-200"
          :aria-label="readArticleAriaLabel"
        >
          {{ t('blog.card.readMore') }}

          <span aria-hidden="true">
            →
          </span>
        </RouterLink>
      </div>
    </div>
  </article>
</template>