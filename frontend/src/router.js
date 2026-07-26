// src/router.js

import {
  createRouter,
  createWebHistory,
} from 'vue-router'

import { api } from './api/http'

// ========================================================
// OSNOVNE JAVNE STRANICE
// ========================================================

import Home from './pages/Home.vue'
import About from './pages/About.vue'
import Contact from './pages/Contact.vue'
import Changelog from './pages/Changelog.vue'
import Customers from './pages/Customers.vue'
import Customer from './pages/Customer.vue'
import Dashboard from './pages/Dashboard.vue'
import Projects from './pages/Projects.vue'
import Pricing from './pages/Pricing.vue'
import SelectTemplate from './pages/SelectTemplate.vue'
import Hosting from './pages/Hosting.vue'
import Services from './pages/Services.vue'

// ========================================================
// BLOG
// ========================================================

import Blog from './pages/Blog.vue'
import BlogPost from './pages/BlogPost.vue'

// ========================================================
// AUTENTIFIKACIJA
// ========================================================

import SignIn from './pages/SignIn.vue'
import SignUp from './pages/SignUp.vue'
import ResetPassword from './pages/ResetPassword.vue'

// ========================================================
// ADMIN
// ========================================================

import AdminDashboard from './pages/AdminDashboard.vue'
import AdminUsers from './partials/admin/AdminUsers.vue'

// ========================================================
// SERVISI
// ========================================================

import ServiceFreeSite from './services/ServiceFreeSite.vue'
import ServiceProSite from './services/ServiceProSite.vue'
import ServiceW3Site from './services/ServiceW3Site.vue'
import ServiceCruipSite from './services/ServiceCruipSite.vue'
import ServiceOriginalSite from './services/ServiceOriginalSite.vue'
import ServiceOnlineshop from './services/ServiceOnlineshop.vue'
import ServiceUniShop from './services/ServiceUniShop.vue'
import ServiceDomainHosting from './services/ServiceDomainHosting.vue'
import ServiceMaintenance from './services/ServiceMaintenance.vue'
import ServiceDesign from './services/ServiceDesign.vue'
import ServiceSeo from './services/ServiceSeo.vue'
import ServiceMarketing from './services/ServiceMarketing.vue'
import ServiceTranslations from './services/ServiceTranslations.vue'
import ServiceIntegrations from './services/ServiceIntegrations.vue'
import ServiceAiAutomation from './services/ServiceAiAutomation.vue'

// ========================================================
// FORME I JAVNI PREGLEDI
// ========================================================

import FreeSiteForm from './pages/FreeSiteForm.vue'
import ProSiteForm from './services/ProSiteForm.vue'
import DemoFree from './services/DemoFree.vue'
import Preview from './pages/PresentationView.vue'
import PublicPresentation from './pages/PublicPresentation.vue'

const routes = [
  // ======================================================
  // JAVNE STRANICE
  // ======================================================

  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/about',
    name: 'About',
    component: About,
  },
  {
    path: '/contact',
    name: 'Contact',
    component: Contact,
  },
  {
    path: '/changelog',
    name: 'Changelog',
    component: Changelog,
  },
  {
    path: '/pricing',
    name: 'Pricing',
    component: Pricing,
  },
  {
    path: '/hosting',
    name: 'Hosting',
    component: Hosting,
  },
  {
    path: '/services',
    name: 'Services',
    component: Services,
  },
  {
    path: '/projects',
    name: 'Projects',
    component: Projects,
  },

  // ======================================================
  // BLOG
  // ======================================================

  {
    path: '/blog',
    name: 'Blog',
    component: Blog,
  },
  {
    path: '/blog/:slug',
    name: 'BlogPost',
    component: BlogPost,
    props: true,
  },

  // ======================================================
  // INTEGRACIJE
  // ======================================================

  {
    path: '/integrations',
    name: 'Integrations',
    component: () =>
      import('./pages/Integrations.vue'),
  },
  {
    path: '/integrations-single',
    name: 'IntegrationsSingle',
    component: () =>
      import('./pages/IntegrationsSingle.vue'),
    meta: {
      requiresAuth: true,
    },
  },

  // ======================================================
  // KORISNICI I KLIJENTI
  // ======================================================

  {
    path: '/customers',
    name: 'Customers',
    component: Customers,
    meta: {
      requiresAuth: true,
    },
  },
  {
    path: '/customer',
    name: 'Customer',
    component: Customer,
    meta: {
      requiresAuth: true,
    },
  },

  // ======================================================
  // DASHBOARD
  // ======================================================

  {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard,
    meta: {
      requiresAuth: true,
    },
  },

  // ======================================================
  // AUTENTIFIKACIJA
  // ======================================================

  {
    path: '/signin',
    name: 'SignIn',
    component: SignIn,
    meta: {
      guestOnly: true,
    },
  },
  {
    path: '/signup',
    name: 'SignUp',
    component: SignUp,
    meta: {
      guestOnly: true,
    },
  },
  {
    path: '/reset-password',
    name: 'ResetPassword',
    component: ResetPassword,
    meta: {
      guestOnly: true,
    },
  },

  // ======================================================
  // ADMIN
  // ======================================================

  {
    path: '/admin/dashboard',
    name: 'AdminDashboard',
    component: AdminDashboard,
    meta: {
      requiresAuth: true,
      requiresAdmin: true,
    },
  },
  {
    path: '/admin/users',
    name: 'AdminUsers',
    component: AdminUsers,
    meta: {
      requiresAuth: true,
      requiresAdmin: true,
    },
  },

  // ======================================================
  // SERVISI
  // ======================================================

  {
    path: '/services/freesite',
    name: 'FreeSite',
    component: ServiceFreeSite,
    props: {
      slug: 'freesite',
    },
  },
  {
    path: '/services/prosite',
    name: 'ServiceProSite',
    component: ServiceProSite,
    props: {
      slug: 'prosite',
    },
  },
  {
    path: '/services/w3site',
    name: 'ServiceW3Site',
    component: ServiceW3Site,
    props: {
      slug: 'w3site',
    },
  },
  {
    path: '/services/cruipsite',
    name: 'ServiceCruipSite',
    component: ServiceCruipSite,
    props: {
      slug: 'cruipsite',
    },
  },
  {
    path: '/services/originalsite',
    name: 'ServiceOriginalSite',
    component: ServiceOriginalSite,
    props: {
      slug: 'originalsite',
    },
  },
  {
    path: '/services/basicshop',
    name: 'ServiceOnlineshop',
    component: ServiceOnlineshop,
    props: {
      slug: 'basicshop',
    },
  },
  {
    path: '/services/unishop',
    name: 'ServiceUniShop',
    component: ServiceUniShop,
    props: {
      slug: 'unishop',
    },
  },
  {
    path: '/services/domain-hosting',
    name: 'ServiceDomainHosting',
    component: ServiceDomainHosting,
    props: {
      slug: 'domain-hosting',
    },
  },
  {
    path: '/services/maintenance',
    name: 'ServiceMaintenance',
    component: ServiceMaintenance,
    props: {
      slug: 'maintenance',
    },
  },
  {
    path: '/services/design',
    name: 'ServiceDesign',
    component: ServiceDesign,
    props: {
      slug: 'design',
    },
  },
  {
    path: '/services/seo',
    name: 'ServiceSeo',
    component: ServiceSeo,
    props: {
      slug: 'seo',
    },
  },
  {
    path: '/services/marketing',
    name: 'ServiceMarketing',
    component: ServiceMarketing,
    props: {
      slug: 'marketing',
    },
  },
  {
    path: '/services/translation',
    name: 'ServiceTranslations',
    component: ServiceTranslations,
    props: {
      slug: 'translations',
    },
  },
  {
    path: '/services/integrations',
    name: 'ServiceIntegrations',
    component: ServiceIntegrations,
    props: {
      slug: 'integrations',
    },
  },
  {
    path: '/services/ai-automation',
    name: 'ServiceAiAutomation',
    component: ServiceAiAutomation,
    props: {
      slug: 'ai-automation',
    },
  },

  // ======================================================
  // JAVNE PREZENTACIJE
  // ======================================================

  {
    path: '/print/:slug',
    name: 'PublicPresentationPrint',
    component: PublicPresentation,
    props: true,
  },
  {
    path: '/preview/:slug',
    name: 'PublicPresentationPreview',
    component: PublicPresentation,
    props: true,
  },

  // ======================================================
  // FORME ZA SAJTOVE
  // ======================================================

  {
    path: '/free-site-form',
    name: 'FreeSiteForm',
    component: FreeSiteForm,
  },
  {
    path: '/pro-site-form',
    name: 'ProSiteForm',
    component: ProSiteForm,
  },

  // ======================================================
  // PREGLED PREZENTACIJA
  // ======================================================

  {
    path: '/prezentacije/demo-free',
    name: 'DemoFree',
    component: DemoFree,
    props: {
      slug: 'demo-free',
    },
  },
  {
    path: '/prezentacije/:slug',
    name: 'Preview',
    component: Preview,
    props: true,
  },

  // ======================================================
  // IZBOR ŠABLONA
  // ======================================================

  {
    path: '/select-template',
    name: 'SelectTemplate',
    component: SelectTemplate,
  },

  // ======================================================
  // STRIPE
  // ======================================================

  {
    path: '/stripe-test',
    name: 'StripeTest',
    component: () =>
      import('./partials/StripeTest.vue'),
  },

  // ======================================================
  // KORPA I NAPLATA
  // ======================================================

  {
    path: '/checkout',
    name: 'Checkout',
    component: () =>
      import('./pages/CheckoutPage.vue'),
  },

  // ======================================================
  // IZMENA SAJTA
  // ======================================================

  {
    path: '/edit-site/:slug',
    name: 'EditSite',
    component: () =>
      import('./pages/EditSite.vue'),
    props: true,
  },

  // ======================================================
  // DEMO PREGLEDI
  // ======================================================

  {
    path: '/demo',
    name: 'DemoPreviews',
    component: () =>
      import('./pages/DemoPreviews.vue'),
  },

  // ======================================================
  // FOOTER STRANICE
  // ======================================================

  {
    path: '/footer/products/features',
    name: 'FooterFeatures',
    component: () =>
      import('./pages/footer/products/Features.vue'),
  },
  {
    path: '/footer/products/integrations',
    name: 'FooterIntegrations',
    component: () =>
      import('./pages/footer/products/Integrations.vue'),
  },
  {
    path: '/footer/products/changelog',
    name: 'ChangelogPage',
    component: () =>
      import('./pages/footer/products/Changelog.vue'),
  },
  {
    path: '/footer/products/method',
    name: 'MethodPage',
    component: () =>
      import('./pages/footer/products/Method.vue'),
  },
  {
    path: '/footer/company/about',
    name: 'AboutPage',
    component: () =>
      import('./pages/footer/company/About.vue'),
  },
  {
    path: '/footer/company/diversity',
    name: 'DiversityPage',
    component: () =>
      import('./pages/footer/company/Diversity.vue'),
  },

  // Stara footer blog stranica ostaje dostupna,
  // ali koristi drugo ime rute.
  {
  path: '/footer/company/blog',
  redirect: '/blog',
},

  {
    path: '/footer/company/careers',
    name: 'CareersPage',
    component: () =>
      import('./pages/footer/company/Careers.vue'),
  },
  {
    path: '/footer/company/financials',
    name: 'FinancePage',
    component: () =>
      import('./pages/footer/company/Finance.vue'),
  },
  {
    path: '/footer/resources/community',
    name: 'CommunityPage',
    component: () =>
      import('./pages/footer/resources/Community.vue'),
  },
  {
    path: '/footer/resources/terms',
    name: 'TermsPage',
    component: () =>
      import('./pages/footer/resources/Terms.vue'),
  },
  {
    path: '/footer/resources/vulnerability',
    name: 'VulnerabilityPage',
    component: () =>
      import('./pages/footer/resources/Vulnerability.vue'),
  },
  {
    path: '/footer/legals/refund',
    name: 'RefundPage',
    component: () =>
      import('./pages/footer/legals/Refund.vue'),
  },
  {
    path: '/footer/legals/terms_conditions',
    name: 'TermsConditionsPage',
    component: () =>
      import('./pages/footer/legals/Terms.vue'),
  },
  {
    path: '/footer/legals/privacy',
    name: 'PrivacyPage',
    component: () =>
      import('./pages/footer/legals/Privacy.vue'),
  },
  {
    path: '/footer/legals/cookie-policy',
    name: 'CookiePolicyPage',
    component: () =>
      import('./pages/footer/legals/CookiePolicy.vue'),
  },
  {
    path: '/footer/legals/brandkit',
    name: 'BrandPage',
    component: () =>
      import('./pages/footer/legals/Brandkit.vue'),
  },

  // ======================================================
  // DODATNE STRANICE
  // ======================================================

  {
    path: '/pricing-detailed',
    name: 'PricingDetailed',
    component: () =>
      import('@/partials/PricingDetailed.vue'),
  },

  // ======================================================
  // 404
  // ======================================================

  {
    path: '/:pathMatch(.*)*',
    name: 'NotFound',
    component: () =>
      import('./pages/NotFound.vue'),
  },
]

const router = createRouter({
  history: createWebHistory(),

  routes,

  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    }

    if (to.hash) {
      return {
        el: to.hash,
        behavior: 'smooth',
      }
    }

    return {
      top: 0,
      left: 0,
    }
  },
})

// ========================================================
// SERVER-SIDE AUTH PROVERA
// ========================================================

let cachedUser = null
let userRequest = null

async function getAuthenticatedUser() {
  if (cachedUser) {
    return cachedUser
  }

  if (userRequest) {
    return userRequest
  }

  userRequest = api
    .get('/user')
    .then((response) => {
      cachedUser = response.data

      return cachedUser
    })
    .catch(() => {
      cachedUser = null

      return null
    })
    .finally(() => {
      userRequest = null
    })

  return userRequest
}

// ========================================================
// GLOBALNI ROUTER GUARD
// ========================================================

router.beforeEach(async (to) => {
  const requiresAuth = Boolean(
    to.meta?.requiresAuth,
  )

  const requiresAdmin = Boolean(
    to.meta?.requiresAdmin,
  )

  const guestOnly = Boolean(
    to.meta?.guestOnly,
  )

  let user = cachedUser

  if (
    requiresAuth ||
    requiresAdmin ||
    guestOnly
  ) {
    user = await getAuthenticatedUser()
  }

  // Zaštićene stranice
  if (requiresAuth && !user) {
    return {
      path: '/signin',
      query: {
        redirect: to.fullPath,
      },
    }
  }

  // Prijavljeni korisnik ne treba ponovo da vidi
  // signin i signup stranice.
  if (guestOnly && user) {
    const redirectTarget =
      typeof to.query.redirect === 'string' &&
      to.query.redirect.startsWith('/')
        ? to.query.redirect
        : '/dashboard'

    return {
      path: redirectTarget,
    }
  }

  // Administratorske stranice
  if (requiresAdmin) {
    if (!user) {
      return {
        path: '/signin',
        query: {
          redirect: to.fullPath,
        },
      }
    }

    const allowedRoles = [
      'admin',
      'superadmin',
    ]

    if (!allowedRoles.includes(user.role)) {
      return {
        path: '/dashboard',
      }
    }
  }

  return true
})

// ========================================================
// JAVNO RESETOVANJE AUTH KEŠA
// ========================================================

export function resetAuthCache() {
  cachedUser = null
  userRequest = null
}

export default router