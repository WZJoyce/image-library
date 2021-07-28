<template>
  <div>
    <div>
      <circlespinner v-if="isLoading"></circlespinner>
    </div>
    <vue-flex-waterfall
      col="4"
      col-spacing="15"
      :break-at="{ 1327: 3, 990: 2, 655: 1 }"
      :break-by-container="true"
      class="bg-gray-200"
    >
      <ul v-if="imagesList.length != 0" v-for="item in imagesList">
        <showcard
          v-if="isLoading == false"
          :ref-message="item.urls.small"
          :id="item.id"
          :ref-messagefull="item.urls.full"
          btnDelete="0"
          :home="true"
        ></showcard>
      </ul>
    </vue-flex-waterfall>
    <div
      class="flex justify-center"
      v-if="imagesList.length != 0 && isLoading == false"
    >
      <prenext
        :page="page"
        :totalPages="totalPages"
        @change-page="changePage"
        class="py-12"
      ></prenext>
    </div>
    <p class="p-image" v-if="noResults">No image</p>
  </div>
</template>

<script>
import Navbar from "@/components/commons/Navbar";
import Showcard from "@/components/commons/Showcard";
import VueFlexWaterfall from "@/components/commons/Waterfall";
import Prenext from "@/components/commons/Prenext";
import Circlespinner from "@/components/commons/Circlespinner";

export default {
  name: "home",
  layout: Navbar,
  components: {
    Showcard,
    VueFlexWaterfall,
    Prenext,
    Circlespinner,
  },
  data() {
    return {
      imagesList: [],
      page: 1,
      perPage: 30,
      search: " ",
      totalPages: 0,
      noResults: false,
      isLoading: false,
    };
  },
  created() {
    var data = window.location.href.split("?")[1].split("=")[1];
    this.search = data;
    this.searchValue(data);
  },
  watch: {
    "$page.props.search"(val) {
      if (val.click) {
        this.searchValue();
        this.$page.props.search.click = false;
      }
    },
  },
  methods: {
    changePage: function(page) {
      //prenext give the value to pageValue
      this.page = page;
      this.searchImages();
    },
    searchValue(data) {
      if (this.search == 0) return;
      this.search = data;
      this.page = 1;
      this.searchImages();
    },
    //acquire the images from unsplash
    searchImages: function() {
      this.isLoading = true;
      var vm = this;
      let data = new URLSearchParams({
        search: this.search,
        page: this.page,
        perPage: this.perPage,
      }).toString();
      axios
        .get(this.$page.props.unsplashSearch + "?" + data)
        .then(function(response) {
          vm.isLoading = false;
          vm.imagesList = response.data.results;
          vm.totalPages = response.data.total_pages;
          if (vm.totalPage === 0) {
            vm.noResults = true;
          }
          window.scrollTo(0, 0);
        })
        .catch(function(err) {
          vm.noResults = true;
          console.error(err);
        });
    },
  },
};
</script>

<style>
.p-image {
  @apply text-center bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-blue-500 text-4xl font-bold;
}
</style>
