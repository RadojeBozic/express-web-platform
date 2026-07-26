import { createRouter, createWebHistory } from 'vue-router'

// 🔹 Osnovne stranice
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

// 🔹 Autentifikacija
import SignIn from './pages/SignIn.vue'
import SignUp from './pages/SignUp.vue'
import ResetPassword from './pages/ResetPassword.vue'
import { isAuthenticated } from './utils/auth'

// 🔹 Admin sekcija
import AdminDashboard from './pages/AdminDashboard.vue'
import AdminUsers from './partials/admin/AdminUsers.vue'

// 🔹 Stranice za integracije
import Integrations from './pages/Integrations.vue'
import IntegrationsSingle from './pages/IntegrationsSingle.vue'

// 🔹 Servisi

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


import PublicPresentation from './pages/PublicPresentation.vue'




// 🔹 Forme i pregledi
import FreeSiteForm from './pages/FreeSiteForm.vue'
import ProSiteForm from './services/ProSiteForm.vue'
import DemoFree from './services/DemoFree.vue'
import Preview from './pages/PresentationView.vue'
//import ServiceTranslations from './services/ServiceTranslations.vue'


const router = createRouter({
  history: createWebHistory(),
  scrollBehavior() {
    window.scrollTo({ top: 0 })
  },
  routes: [
    // 🌐 Javne stranice
    { path: '/', component: Home },
    { path: '/about', component: About },
    { path: '/contact', name: 'contact', component: Contact },
    { path: '/changelog', component: Changelog },
    { path: '/pricing', component: Pricing },

    // 🧩 Integracije
    { path: '/integrations', component: Integrations },
    { path: '/integrations-single', component: IntegrationsSingle, meta: { requiresAuth: true } },

    // 👥 Korisnici i klijenti
    { path: '/customers', component: Customers, meta: { requiresAuth: true } },
    { path: '/customer', component: Customer, meta: { requiresAuth: true } },

    // 🧾 Projekti i dashboard
    { path: '/projects', component: Projects, meta: { requiresAuth: true } },
    { path: '/dashboard', component: Dashboard, meta: { requiresAuth: true } },

    // 🔐 Autentifikacija
    { path: '/signin', component: SignIn },
    { path: '/signup', component: SignUp },
    { path: '/reset-password', component: ResetPassword },

    // 🛠️ Admin sekcija
    {
      path: '/admin/dashboard',
      name: 'AdminDashboard',
      component: AdminDashboard,
      meta: { requiresAuth: true, role: 'admin' }
    },
    {
      path: '/admin/users',
      name: 'AdminUsers',
      component: AdminUsers,
      meta: { requiresAuth: true, role: 'admin' }
    },

    // 🧰 Servisi
    { path: '/services/freesite', name: 'FreeSite', component: ServiceFreeSite, props: { slug: 'freesite' } },
    { path: '/services/prosite', name: 'ServiceProSite', component: ServiceProSite, props: { slug: 'prosite' } },
    { path: '/services/w3site', name: 'ServiceW3Site', component: ServiceW3Site, props: { slug: 'w3site' } },
    { path: '/services/cruipsite', name: 'ServiceCruipSite', component: ServiceCruipSite, props: { slug: 'cruipsite' } },
    { path: '/services/originalsite', name: 'ServiceOriginalSite', component: ServiceOriginalSite, props: { slug: 'originalsite' } },
    { path: '/services/basicshop', name: 'ServiceOnlineshop', component: ServiceOnlineshop, props: { slug: 'basicshop' } },
    { path: '/services/unishop', name: 'ServiceUniShop', component: ServiceUniShop, props: { slug: 'unishop' } },
    { path: '/services/domain-hosting', name: 'ServiceDomainHosting', component: ServiceDomainHosting, props: { slug: 'domain-hosting' } },
    { path: '/services/maintenance', name: 'ServiceMaintenance', component: ServiceMaintenance, props: { slug: 'maintenance' } },
    { path: '/services/design', name: 'ServiceDesign', component: ServiceDesign, props: { slug: 'design' } },
    { path: '/services/seo', name: 'ServiceSeo', component: ServiceSeo, props: { slug: 'seo' } },
    { path: '/services/marketing', name: 'ServiceMarketing', component: ServiceMarketing, props: { slug: 'marketing' } },
    { path: '/services/translation', name: 'ServiceTranslations', component: ServiceTranslations, props: { slug: 'translations' } },

    // 📄 Javne prezentacije
    { 
      path: '/print/:slug', 
      name: 'PublicPresentation', 
      component: PublicPresentation, 
      props: true 
    },
    {
      path: '/preview/:slug',
      name: 'PublicPresentation',
      component: () => import('./pages/PublicPresentation.vue'),
      props: true
    },
    
    // 📝 Forme za sajtove
    { path: '/free-site-form', name: 'FreeSiteForm', component: FreeSiteForm },
    { path: '/pro-site-form', name: 'ProSiteForm', component: ProSiteForm },

    // 🔎 Pregled prezentacija
    { path: '/prezentacije/demo-free', name: 'DemoFree', component: DemoFree, props: { slug: 'demo-free' } },
    { path: '/prezentacije/:slug', name: 'Preview', component: Preview, props: true },

    // 🧩 Template izbor
    { path: '/select-template', name: 'SelectTemplate', component: SelectTemplate },

    // Stripe naplata
    {
      path: '/stripe-test',
      name: 'StripeTest',
      component: () => import('./partials/StripeTest.vue'),
    },

    // 🛒 Korpa i naplata
    {
      path: '/checkout',
      name: 'Checkout',
      component: () => import('./pages/CheckoutPage.vue')
    },

    // ✏️ Izmena sajta
    {
      path: '/edit-site/:slug',
      name: 'EditSite',
      component: () => import('./pages/EditSite.vue'),
      props: true
    },
    // 🛠️ Ostale stranice
    { path: '/admin', redirect: '/admin/dashboard' },
    {
      path: '/demo',
      name: 'DemoPreviews',
      component: () => import('./pages/DemoPreviews.vue')
    },
    {
      path: '/prezentacije/demo-klasicni-free',
      name: 'DemoFreeClassic',
      component: Preview,
      props: { slug: 'demo-klasicni-free' }
    },
    {
      path: '/prezentacije/demo-klasicni-pro',
      name: 'DemoProClassic',
      component: Preview,
      props: { slug: 'demo-klasicni-pro' }
    },
    {
      path: '/prezentacije/demo-klasicni-active',
      name: 'DemoActiveClassic',
      component: Preview,
      props: { slug: 'demo-klasicni-active' }
    },
    {
      path: '/demo',
      name: 'DemoPreviews',
      component: () => import('./pages/DemoPreviews.vue')
    },

    // Footer links
    {
  path: '/footer/products/features',
  name: 'FooterFeatures',
  component: () => import('./pages/footer/products/Features.vue')
},
    {
      path: '/footer/products/integrations',
      name: 'FooterIntegrations',
      component: () => import('./pages/footer/products/Integrations.vue')
    }, 
    {
      path: '/footer/products/changelog',
      name: 'ChangelogPage',
      component: () => import('./pages/footer/products/Changelog.vue')
    },
    {
      path: '/footer/products/method',
      name: 'MethodPage',
      component: () => import('./pages/footer/products/Method.vue')
    },
    {
      path: '/footer/company/about',
      name: 'AboutPage',
      component: () => import('./pages/footer/company/About.vue')
    },
    {
      path: '/footer/company/diversity',
      name: 'DiversityPage',
      component: () => import('./pages/footer/company/Diversity.vue')
    },
    {
      path: '/footer/company/blog',
      name: 'BlogPage',
      component: () => import('./pages/footer/company/Blog.vue')
    },
    {
      path: '/footer/company/careers',
      name: 'CareersPage',
      component: () => import('./pages/footer/company/Careers.vue')
    },
    {
      path: '/footer/company/financials',
      name: 'FinancePage',
      component: () => import('./pages/footer/company/Finance.vue')
    },
    {
      path: '/footer/resources/community',
      name: 'CommunityPage',
      component: () => import('./pages/footer/resources/Community.vue')
    },
    {
      path: '/footer/resources/terms',
      name: 'TermsPage',
      component: () => import('./pages/footer/resources/Terms.vue')
    },
    {
      path: '/footer/resources/vulnerability',
      name: 'VulnerabilityPage',
      component: () => import('./pages/footer/resources/Vulnerability.vue')
    },
    {
      path: '/footer/legals/refund',
      name: 'RefundPage',
      component: () => import('./pages/footer/legals/Refund.vue')
    },
    {
      path: '/footer/legals/terms_conditions',
      name: 'TermsConditionsPage',
      component: () => import('./pages/footer/legals/Terms.vue')
    },
    {
      path: '/footer/legals/privacy',
      name: 'PrivacyPage',
      component: () => import('./pages/footer/legals/Privacy.vue')
    },
    {
      path: '/footer/legals/brandkit',
      name: 'BrandkitPage',
      component: () => import('./pages/footer/legals/Brandkit.vue')
    },
    {
      path: '/cookie-policy',
      name: 'cookie.policy',
      component: () => import('./pages/footer/resources/CookiePolicy.vue'),
      meta: { public: true }
    },

    // Nove stranice
    {
      path: '/pricing-detailed',
      name: 'PricingDetailed',
      component: () => import('@/partials/PricingDetailed.vue')
    },


  ]
})



// 🔐 Middleware zaštita pristupa
router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !isAuthenticated()) {
    return next('/signin')
  }
  next()
})

// (Opcionalno) global error handler za 401/403
router.afterEach(() => {
    setTimeout(() => {
      if (typeof window.plausible === 'function') {
        window.plausible('pageview')
      }
    }, 0)
  })


export default router
