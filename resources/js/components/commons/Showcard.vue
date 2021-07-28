<template>
  <div
    class="image-container dark:bg-gray-800"
    :class="{
      'border-green-800 border-2 rounded': tem && home,
    }"
  >
   
     <img :src="refMessage" />
    <div class="title-border" v-if="titleshow">
      <p class="showcard-font">{{ titleshow }}</p>
    </div>

    <div class="form-container">
      <div class="form-col">
        <div class="form-flex">
          <button
            class="form-button"
            @click.stop="editClick"
          >
           <p class="showcard-font">Edit</p>
          </button>
          <button
            class="form-button"
            @click="imageSave">
           <p class="showcard-font">Save</p>
          </button>

          <button
            class="form-button"
            @click="destroyImages"
            v-if="btnDelete == 1"
          >
           <p class="showcard-font">Delete</p>
          </button>
        </div>
        <div class="form-show" v-show="open">
          <div class="form-size space-y-6">
           <span class="block">
             <p class="showcard-font">Title</p>
             <textarea  type = "number"
    maxlength = "40" rows="2"   v-model.lazy="title" class="title-format">{{title}}</textarea>
           </span>
           <span class="block">
             <p class="showcard-font">Description</p>
                <textarea
                  v-model.lazy="description"
                  rows="3"
                  class="description-format"
                  >{{ description }}</textarea>
           </span>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Modal from "@burhanahmeed/vue-modal-2";
export default {
  name: "Showcard",
  props: {
    revealEdit: Boolean,
    showImage: String,
    searchMassege: String,
    refMessage: String,
    refMessagefull: String,
    revealBar: Boolean,
    id: String,  
    des: String,
    tit:String,
    isborder: Boolean,
    btnDelete: String,
    home: Boolean,
    
  },

  components: {
    Modal,
  },
  created() {
    this.highlightImages();
    this.title=this.tit;
    this.description=this.des;
  },
  data() {
    return {
      open: false,
      tem: false,
      title: '',
      description: '',
      titleshow: '',
    };
  },
  methods: {
    //the edit area shows after clicking edit button
    editClick() {
      this.open = !this.open;
    },
    //save a image to the media library
    imageSave() {
      var vm = this;
      this.open = false;
      axios
          .post(this.$page.props.image, {
            id: vm.id,
            title: vm.title,
            description: vm.description,
            url: vm.refMessage,
            urlfull: vm.refMessagefull,
          })
          .then(function(response) {
            vm.tem = true;
            vm.titleshow = vm.title
          })
          .catch((err) => console.error(err));
    },
    //delete a image in the media library
    destroyImages: function() {
      var vm = this;
      let url = this.$page.props.imageDestroy.replace(":id", vm.id);
      axios
        .delete(url)
        .then(function(response) {
         vm.$emit('reloaddata', true);
        })
        .catch((err) => console.error(err.response));
    },
    //highlight images if they are in the media library
    highlightImages: function() {
      var vm = this;
      let url = this.$page.props.imageHighlight.replace(":id", vm.id);
      axios
        .get(url)
        .then(function(response) {
          if (response.data) {
            //add border and description
            vm.tem = true;
            vm.title = response.data.title;
            vm.description = response.data.description;
            vm.titleshow = response.data.title;
          }
        })
        .catch((err) => console.error(err));
    },
  },
};
</script>

<style scoped>
.image-container {
  @apply max-w-xs mx-auto overflow-hidden bg-white rounded-lg shadow-lg mt-4;
}
.image-enlarge {
  @apply object-cover w-full h-auto
}

.showcard-font{
  @apply font-serif font-normal
}
.form-container{
   @apply px-4 py-2 items-center
}
.title-border{
  @apply px-2 border-b border-black
}
.form-col{
  @apply mt-5 md:mt-0 md:col-span-2
}
.form-flex{
   @apply flex items-center justify-between px-4 py-2 bg-white
}
.form-button{
  @apply px-2 py-1  text-gray-900 transition-colors duration-200 transform bg-white rounded hover:bg-blue-200 focus:bg-blue-300 focus:outline-none
}

.form-show{
  @apply shadow sm:rounded-md sm:overflow-hidden
}

.form-size{
  @apply px-4 py-5 bg-white sm:p-6
}

.title-format{
  @apply shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md resize-none
}

.description-format{
  @apply shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md
}

</style>
