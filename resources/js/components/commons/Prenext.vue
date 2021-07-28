<template>
  <div class="inline-flex items-center">
    <button class="page-button" @click="changePage(1)" :disabled="this.page==1">
        First
    </button>
    <button class="page-button" @click="changePage(page - 1)" :disabled="this.page==1">
      Prev
    </button>
    <span>Page: {{ page }}</span>
    </button>
    <button class="page-button" @click="changePage(page + 1)" :disabled="this.page==this.totalPages">
      Next
    </button>
    <button class="page-button" @click="changePage(totalPages)" :disabled="this.page==this.totalPages">
      Last
    </button>
  </div>
</template>
<script>

export default {
  name: "Prenext",
  props: {
    page: {
      required: true,
      type: Number
    },
    totalPages: {
      required: true,
      type: Number
    }
  },
  data() {
    return {}
  },
  methods: {
    //the previous page, the next page, the first page, the last page
    changePage: function(page) {
      this.page=page;
      if (this.page < 1 || this.page>this.totalPages) {
        return;
      }
      this.$emit('change-page', page)
     
    }
  },
};
</script>

<style>
.page-button {
  @apply bg-white w-auto flex justify-end items-center text-gray-800 p-2 hover:text-gray-400 disabled:text-gray-300 rounded-l font-bold;
}
</style>
