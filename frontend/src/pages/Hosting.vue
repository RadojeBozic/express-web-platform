<template>
  <div class="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">

    <!-- Site header -->
    <Header />

    <!-- Page content -->
    <main class="grow">
      <HostingPage />
      <ChatWidget />
    </main>

    <!-- Site footer -->
    <Footer />

  </div>
</template>

<script>
import Header from '../partials/Header.vue'
import Footer from '../partials/Footer.vue'
import ChatWidget from '../partials/ChatWidget.vue'
import HostingPage from '../partials/HostingPage.vue'

export default {
  name: 'Hosting',
  components: {
    Header,
    Footer,
    ChatWidget,
    HostingPage
  }
}
</script>