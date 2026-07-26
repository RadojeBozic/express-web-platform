import { posts } from '../data/posts'
import { categories } from '../data/categories'
import { authors } from '../data/authors'

const getPublishedPosts = () =>
  posts
    .filter((post) => post.published)
    .sort(
      (firstPost, secondPost) =>
        new Date(secondPost.publishedAt).getTime() -
        new Date(firstPost.publishedAt).getTime(),
    )

export function getPosts() {
  return getPublishedPosts()
}

export function getFeaturedPosts() {
  return getPublishedPosts().filter((post) => post.featured)
}

export function getPostBySlug(slug) {
  return getPublishedPosts().find((post) => post.slug === slug) ?? null
}

export function getPostsByCategory(categorySlug) {
  return getPublishedPosts().filter(
    (post) => post.category === categorySlug,
  )
}

export function getCategories() {
  return categories
}

export function getCategoryBySlug(slug) {
  return categories.find((category) => category.slug === slug) ?? null
}

export function getAuthors() {
  return authors
}

export function getAuthorBySlug(slug) {
  return authors.find((author) => author.slug === slug) ?? null
}

export function getRelatedPosts(currentPost, limit = 3) {
  if (!currentPost) {
    return []
  }

  return getPublishedPosts()
    .filter(
      (post) =>
        post.slug !== currentPost.slug &&
        post.category === currentPost.category,
    )
    .slice(0, limit)
}