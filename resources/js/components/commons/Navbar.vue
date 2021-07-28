<template>
  <main>
    <header>
      <nav class="format-navbar">
        <div class="container-navbar">
          <div class="flex-navbar">
          </div>
          <div>
            <ul class="flex-button">
              <li class="nav-item">
                <inertia-link
                  class="link-button"
                  :href="'/home?query=' + search"
                >
                  Home
                </inertia-link>
              </li>
              <li class="nav-item">
                <inertia-link class="link-button" href="/medialibrary">
                  Image Library
                </inertia-link>
              </li>
              <li class="nav-item">
                <div class="shadow flex">
                  <input
                    class="w-full px-3 py-2 rounded p-2"
                    type="text"
                    placeholder="Search..."
                    v-model="search"
                  />
                  <button class="search-button">
                    <inertia-link
                      :href="'/home?query=' + search"
                      class="search-text"
                      >Search</inertia-link
                    >
                  </button>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <slot />
  </main>
</template>

<script>
export default {
  name: "Navbar",
  props: {
    searchBar: Boolean,
  },
  created() {
    var data = window.location.href.split("?")[1].split("=")[1];
    this.search = data;
  },
  data() {
    return {
      search: "",
    };
  },
  methods: {
    //pass data to the home page
    searchImages() {
      this.$page.props.search = {
        click: true,
        data: this.search,
      };
    },
  },
};
</script>
<style>
.format-navbar {
  @apply relative flex flex-wrap items-center justify-between px-2 pt-3 bg-white mb-3;
}
.container-navbar {
  @apply container px-4 mx-auto flex flex-wrap items-center justify-between;
}
.flex-navbar {
  @apply relative flex justify-between w-0 md:w-0 sm:w-0 px-4 lg:static lg:w-1/6 xl:w-1/6 2xl:w-1/6 lg:block lg:justify-start;
}
.size-image {
  @apply rounded h-auto align-middle border-none;
}
.flex-button {
  @apply flex flex-col lg:flex-row list-none ml-auto;
}
.link-button {
  @apply px-3 py-2 flex items-center text-xs font-bold leading-snug text-gray-800 hover:text-gray-400;
}
.search-button {
  @apply bg-white w-auto flex justify-end items-center text-gray-800 rounded p-2 hover:text-gray-400;
}
.search-text {
  @apply font-bold text-xs;
}
</style>
