<template>
  <section>
    <div class="relative max-w-6xl mx-auto px-4 sm:px-6">

      <!-- Particles animation -->
      <div class="absolute inset-0 max-w-6xl mx-auto px-4 sm:px-6">
        <Particles class="absolute inset-0 -z-10" :quantity="5" />
      </div>

      <div class="py-12 md:py-16">
        <div class="overflow-hidden">
          <div
            class="inline-flex w-full flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)]">
            <ul
              class="flex animate-infinite-scroll items-center justify-center md:justify-start [&_img]:max-w-none [&_li]:mx-8">
              <li>
                <img src="../images/html.svg" alt="html">
              </li>
              <li>
                <img src="../images/css3.svg" alt="css3">
              </li>
              <li>
                <img src="../images/chatgpt.svg" alt="chatgpt">
              </li>
              <li>
                <img src="../images/github.svg" alt="github">
              </li>
              <li>
                <img src="../images/bootstrap.svg" alt="bootstrap">
              </li>
              <li>
                <img src="../images/javascript.svg" alt="javascript">
              </li>
              <li>
                <img src="../images/mysql.svg" alt="mysql">
              </li>
              <li>
                <img src="../images/php.svg" alt="php">
              </li>
              <li>
                <img src="../images/react.svg" alt="react">
              </li>
            </ul>
            <ul
              class="flex animate-infinite-scroll items-center justify-center md:justify-start [&_img]:max-w-none [&_li]:mx-8"
              aria-hidden="true">
              <li>
                <img src="../images/html.svg" alt="html">
              </li>
              <li>
                <img src="../images/css3.svg" alt="css3">
              </li>
              <li>
                <img src="../images/chatgpt.svg" alt="chatgpt">
              </li>
              <li>
                <img src="../images/github.svg" alt="github">
              </li>
              <li>
                <img src="../images/bootstrap.svg" alt="bootstrap">
              </li>
              <li>
                <img src="../images/javascript.svg" alt="javascript">
              </li>
              <li>
                <img src="../images/mysql.svg" alt="mysql">
              </li>
              <li>
                <img src="../images/php.svg" alt="php">
              </li>
              <li>
                <img src="../images/react.svg" alt="react">
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import Particles from './Particles.vue'

export default {
  name: 'Clients',
  components: {
    Particles
  }
}
</script>