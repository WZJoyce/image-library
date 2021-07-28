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
    >
      <ul v-if="imagesList.length != 0" v-for="item in imagesList">
        <showcard
          @reloaddata="reloadData"
          :ref-message="item.url"
          :id="item.id"
          :tit="item.title"
          :des="item.description"
          :ref-messagefull="item.urlfull"
          btnDelete="1"
        ></showcard>
      </ul>
    </vue-flex-waterfall>
    <p class="image-p" v-if="Isimage">No image</p>
  </div>
</template>

<script>
import Navbar from "@/components/commons/Navbar";
import Showcard from "@/components/commons/Showcard";
import VueFlexWaterfall from "@/components/commons/Waterfall";
import Prenext from "@/components/commons/Prenext";
import Circlespinner from "@/components/commons/Circlespinner";
export default {
  name: "mediaLibrary",
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
      isLoading: true,
      Isimage: false,
    };
  },
  created() {
    this.libraryImages();
  },

  methods: {
    //show images in the media library
    libraryImages: function() {
      var vm = this;
      axios
        .get(this.$page.props.imageShow)
        .then(function(response) {
          console.log(response.data);
          vm.isLoading = false;
          vm.imagesList = response.data;
          if (!vm.imagesList.length) {
            vm.Isimage = true;
          }
        })
        .catch((err) => console.error(err));
    },
    reloadData: function(value){
      if(value){
        this.libraryImages();
      }
    }
  },
};
</script>

<style>
.image-p {
  @apply text-center bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-blue-500 text-4xl font-bold;
}
</style>
