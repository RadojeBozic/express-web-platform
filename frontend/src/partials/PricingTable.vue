<template>
  <div class="relative">
    <!-- Blurred shape -->
    <div class="max-md:hidden absolute bottom-0 -mb-20 left-2/3 -translate-x-1/2 blur-2xl opacity-70 pointer-events-none" aria-hidden="true">
      <svg xmlns="http://www.w3.org/2000/svg" width="434" height="427">
        <defs>
          <linearGradient id="bs5-a" x1="19.609%" x2="50%" y1="14.544%" y2="100%">
            <stop offset="0%" stop-color="#A855F7" />
            <stop offset="100%" stop-color="#6366F1" stop-opacity="0" />
          </linearGradient>
        </defs>
        <path fill="url(#bs5-a)" fill-rule="evenodd" d="m661 736 461 369-284 58z" transform="matrix(1 0 0 -1 -661 1163)" />
      </svg>
    </div>
    <!-- Content -->
    <div class="grid md:grid-cols-4 xl:-mx-6 text-sm [&>div:nth-of-type(-n+4)]:py-6 [&>div:nth-last-of-type(-n+4)]:pb-6 max-md:[&>div:nth-last-of-type(-n+4)]:mb-8 max-md:[&>div:nth-of-type(-n+4):nth-of-type(n+1)]:rounded-t-3xl max-md:[&>div:nth-last-of-type(-n+4)]:rounded-b-3xl md:[&>div:nth-of-type(2)]:rounded-tl-3xl md:[&>div:nth-of-type(4)]:rounded-tr-3xl md:[&>div:nth-last-of-type(3)]:rounded-bl-3xl md:[&>div:nth-last-of-type(1)]:rounded-br-3xl [&>div]:bg-slate-700/20 [&>div:nth-of-type(4n+1)]:bg-transparent max-md:[&>div:nth-of-type(4n+5)]:hidden max-md:[&>div:nth-of-type(4n+2)]:order-1 max-md:[&>div:nth-of-type(4n+3)]:order-2 max-md:[&>div:nth-of-type(4n+4)]:order-3 max-md:md:[&>div:nth-of-type(n)]:mb-0 [&>div:nth-of-type(4n+3)]:relative [&>div:nth-of-type(4n+3)]:before:absolute [&>div:nth-of-type(4n+3)]:before:-inset-px [&>div:nth-of-type(4n+3)]:before:rounded-[inherit] [&>div:nth-of-type(4n+3)]:before:border-x-2 [&>div:nth-of-type(3)]:before:border-t-2 [&>div:nth-last-of-type(2)]:before:border-b-2 [&>div:nth-of-type(4n+3)]:before:border-purple-500 [&>div:nth-of-type(4n+3)]:before:-z-10 [&>div:nth-of-type(4n+3)]:before:pointer-events-none">
      <!-- Pricing toggle -->
      <div class="px-6 flex flex-col justify-end">
        <div class="pb-5 md:border-b border-slate-800">
          <!-- Toggle switch -->
          <div class="max-md:text-center">
            <div class="inline-flex items-center whitespace-nowrap">
              <div class="text-sm text-slate-500 font-medium mr-2 md:max-lg:hidden">{{ $t('pricing.toggle.monthly') }}</div>
              <div class="relative">
                <input type="checkbox" id="toggle" class="peer sr-only" v-model="annual" />
                <label for="toggle" class="relative flex h-6 w-11 cursor-pointer items-center rounded-full bg-slate-400 px-0.5 outline-slate-400 transition-colors before:h-5 before:w-5 before:rounded-full before:bg-white before:shadow-xs before:transition-transform before:duration-150 peer-checked:bg-purple-500 peer-checked:before:translate-x-full peer-focus-visible:outline peer-focus-visible:outline-offset-2 peer-focus-visible:outline-gray-400 peer-focus-visible:peer-checked:outline-purple-500">
                  <span class="sr-only">{{ $t('pricing.toggle.pay yearly') }}</span>
                </label>
              </div>
              <div class="text-sm text-slate-500 font-medium ml-2">{{ $t('pricing.toggle.yearly') }}<span class="text-teal-500">(-20%)</span></div>
            </div>
          </div>
        </div>
      </div>
      <!-- Pro price -->
      <div class="px-6 flex flex-col justify-end">
        <div class="grow pb-4 mb-4 border-b border-slate-800">
          <div class="text-base font-medium bg-clip-text text-transparent bg-linear-to-r from-purple-500 to-purple-200 pb-0.5">{{ $t('pricing.plans.pro.title') }}</div>
          <div class="mb-1">
            <span class="text-lg font-medium text-slate-500">€</span><span class="text-3xl font-bold text-slate-50">{{ annual ? '34' : '41' }}</span><span class="text-sm text-slate-600 font-medium">/{{ $t('pricing.plans.pro.mo') }}</span>
          </div>
          <div class="text-slate-500">{{ $t('pricing.plans.pro.label') }}</div>
        </div>
        <div class="pb-4 border-b border-slate-800">
           <router-link
                    to="/services/saas" class="btn-sm text-slate-900 bg-linear-to-r from-white/80 via-white to-white/80 hover:bg-white w-full transition duration-150 ease-in-out group" href="#0">
            {{ $t('pricing.plans.pro.get_started') }}<span class="tracking-normal text-purple-500 group-hover:translate-x-0.5 transition-transform duration-150 ease-in-out ml-1">-&gt;</span>
           </router-link>
        </div>
      </div>
      <!-- Team price -->
      <div class="px-6 flex flex-col justify-end">
        <div class="grow pb-4 mb-4 border-b border-slate-800">
          <div class="text-base font-medium bg-clip-text text-transparent bg-linear-to-r from-purple-500 to-purple-200 pb-0.5">{{ $t('pricing.plans.team.title') }}</div>
          <div class="mb-1">
            <span class="text-lg font-medium text-slate-500">€</span><span class="text-3xl font-bold text-slate-50">{{ annual ? '49' : '59' }}</span><span class="text-sm text-slate-600 font-medium">/{{ $t('pricing.plans.team.mo') }}</span>
          </div>
          <div class="text-slate-500">{{ $t('pricing.plans.team.label') }}</div>
        </div>
        <div class="pb-4 border-b border-slate-800">
          <router-link
                    to="/services/onlineshop" class="btn-sm text-white bg-purple-500 hover:bg-purple-600 w-full transition duration-150 ease-in-out group" href="#0">
            {{ $t('pricing.plans.team.get_started') }}<span class="tracking-normal text-purple-300 group-hover:translate-x-0.5 transition-transform duration-150 ease-in-out ml-1">-&gt;</span>
          </router-link>
        </div>
      </div>
      <!-- Enterprise price -->
      <div class="px-6 flex flex-col justify-end">
        <div class="grow pb-4 mb-4 border-b border-slate-800">
          <div class="text-base font-medium bg-clip-text text-transparent bg-linear-to-r from-purple-500 to-purple-200 pb-0.5">{{ $t('pricing.plans.enterprise.title') }}</div>
          <div class="mb-1">
            <span class="text-lg font-medium text-slate-500">€</span><span class="text-3xl font-bold text-slate-50">{{ annual ? '79' : '95' }}</span><span class="text-sm text-slate-600 font-medium">/{{ $t('pricing.plans.enterprise.mo') }}</span>
          </div>
          <div class="text-slate-500">{{ $t('pricing.plans.enterprise.label') }}</div>
        </div>
        <div class="pb-4 border-b border-slate-800">
          <router-link
                    to="/services/onlineshop" class="btn-sm text-slate-900 bg-linear-to-r from-white/80 via-white to-white/80 hover:bg-white w-full transition duration-150 ease-in-out group" href="#0">
            {{ $t('pricing.plans.enterprise.get_started') }}<span class="tracking-normal text-purple-500 group-hover:translate-x-0.5 transition-transform duration-150 ease-in-out ml-1">-&gt;</span>
          </router-link>
        </div>
      </div>
      <!-- # Usage -->
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-50 font-medium mt-4">{{ $t('pricing.plans.usage') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-50 font-medium mt-4 md:hidden">{{ $t('pricing.plans.usage') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-50 font-medium mt-4 md:hidden">{{ $t('pricing.plans.usage') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-50 font-medium mt-4 md:hidden">{{ $t('pricing.plans.usage') }}</div>
      </div>
      <!-- Social Connections -->
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-400 border-b border-slate-800">{{ $t('pricing.plans.social') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span>5<span class="md:hidden">{{ $t('pricing.plans.social') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span><span class="md:hidden">{{ $t('pricing.plans.social') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span><span class="md:hidden">{{ $t('pricing.plans.social') }}</span></span>
        </div>
      </div>
      <!-- Custom Domains -->
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-400 border-b border-slate-800">{{ $t('pricing.plans.custom') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span><span class="md:hidden">{{ $t('pricing.plans.custom') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span>{{ $t('pricing.plans.unlimited') }}<span class="md:hidden">{{ $t('pricing.plans.custom') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span>{{ $t('pricing.plans.unlimited') }}<span class="md:hidden">{{ $t('pricing.plans.custom') }}</span></span>
        </div>
      </div>
      <!-- User Role Management -->
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-400 border-b border-slate-800">{{ $t('pricing.plans.use_role') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span>{{ $t('pricing.plans.limited') }}<span class="md:hidden">{{ $t('pricing.plans.use_role') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span>{{ $t('pricing.plans.unlimited') }}<span class="md:hidden">{{ $t('pricing.plans.use_role') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span>{{ $t('pricing.plans.unlimited') }}<span class="md:hidden">{{ $t('pricing.plans.use_role') }}</span></span>
        </div>
      </div>
      <!-- External Databases -->
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-400 border-b border-slate-800">{{ $t('pricing.plans.external') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span> <span class="md:hidden">{{ $t('pricing.plans.external') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span> <span class="md:hidden">{{ $t('pricing.plans.external') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span>{{ $t('pricing.plans.unlimited') }}<span class="md:hidden">{{ $t('pricing.plans.external') }}</span></span>
        </div>
      </div>
      <!-- # Features -->
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-50 font-medium mt-4">{{ $t('pricing.plans.features') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-50 font-medium mt-4 md:hidden">{{ $t('pricing.plans.features') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-50 font-medium mt-4 md:hidden">{{ $t('pricing.plans.features') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-50 font-medium mt-4 md:hidden">{{ $t('pricing.plans.features') }}</div>
      </div>
      <!-- Custom Connection -->
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-400 border-b border-slate-800">{{ $t('pricing.plans.customs') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <!-- <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg> -->
          <span><span class="md:hidden">{{ $t('pricing.plans.customs') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span><span class="md:hidden">{{ $t('pricing.plans.customs') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span><span class="md:hidden">{{ $t('pricing.plans.customs') }}</span></span>
        </div>
      </div>
      <!-- Advanced Deployment Options -->
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-400 border-b border-slate-800">{{ $t('pricing.plans.advance') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <!-- <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg> -->
          <span><span class="md:hidden">{{ $t('pricing.plans.advance') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span><span class="md:hidden">{{ $t('pricing.plans.advance') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span><span class="md:hidden">{{ $t('pricing.plans.advance') }}</span></span>
        </div>
      </div>
      <!-- Extra Add-ons -->
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-400 border-b border-slate-800">{{ $t('pricing.plans.extra') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <!-- <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg> -->
          <span><span class="md:hidden">{{ $t('pricing.plans.extra') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span><span class="md:hidden">{{ $t('pricing.plans.extra') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span><span class="md:hidden">{{ $t('pricing.plans.extra') }}</span></span>
        </div>
      </div>
      <!-- Admin Roles -->
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-400 border-b border-slate-800">{{ $t('pricing.plans.ad_roles') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center border-b border-slate-800 py-2 text-slate-400 max-md:hidden">
          <span><span class="md:hidden">{{ $t('pricing.plans.ad_roles') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center border-b border-slate-800 py-2 text-slate-400 max-md:hidden">
          <span><span class="md:hidden">{{ $t('pricing.plans.ad_roles') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span><span class="md:hidden">{{ $t('pricing.plans.ad_roles') }}</span></span>
        </div>
      </div>
      <!-- Deploy and Monitor -->
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-400 border-b border-slate-800">{{ $t('pricing.plans.deploy') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center border-b border-slate-800 py-2 text-slate-400 max-md:hidden">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span><span class="md:hidden">{{ $t('pricing.plans.deploy') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center border-b border-slate-800 py-2 text-slate-400 max-md:hidden">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span><span class="md:hidden">{{ $t('pricing.plans.deploy') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span><span class="md:hidden">{{ $t('pricing.plans.deploy') }}</span></span>
        </div>
      </div>
      <!-- Enterprise Add-ons -->
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-400 border-b border-slate-800">{{ $t('pricing.plans.enterprises') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center border-b border-slate-800 py-2 text-slate-400 max-md:hidden">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span>{{ $t('pricing.plans.spec') }}<span class="md:hidden">{{ $t('pricing.plans.enterprises') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center border-b border-slate-800 py-2 text-slate-400 max-md:hidden">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span>{{ $t('pricing.plans.spec') }}<span class="md:hidden">{{ $t('pricing.plans.enterprises') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span><span class="md:hidden">{{ $t('pricing.plans.enterprises') }}</span></span>
        </div>
      </div>
      <!-- # Support -->
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-50 font-medium mt-4">{{ $t('pricing.plans.support') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-50 font-medium mt-4 hidden">{{ $t('pricing.plans.support') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-50 font-medium mt-4 md:hidden">{{ $t('pricing.plans.support') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-50 font-medium mt-4 md:hidden">{{ $t('pricing.plans.support') }}</div>
      </div>
      <!-- Premium Support -->
      <div class="px-6 flex flex-col justify-end">
        <div class="py-2 text-slate-400 border-b border-slate-800">{{ $t('pricing.plans.premium_supp') }}</div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center border-b border-slate-800 py-2 text-slate-400 max-md:hidden">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span>{{ $t('pricing.plans.spec') }}<span class="md:hidden">{{ $t('pricing.plans.premium_supp') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span>{{ $t('pricing.plans.spec') }}<span class="md:hidden">{{ $t('pricing.plans.premium_supp') }}</span></span>
        </div>
      </div>
      <div class="px-6 flex flex-col justify-end">
        <div class="flex items-center h-full border-b border-slate-800 py-2 text-slate-400">
          <svg class="shrink-0 fill-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" width="12" height="9">
            <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
          </svg>
          <span><span class="md:hidden">{{ $t('pricing.plans.premium_supp') }}</span></span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'

export default {
  name: 'PricingTable',
  setup() {

    const annual = ref(true)

    return {
      annual,
    }
  },
}
</script>