<template>
  <div>
    <div class="paging-info">
      {{pagingInfo}}
    </div>
    <ul class="pagination">

      <li class="pagination-item">
        <button
          type="button"
          @click="onClickFirstPage"
          :disabled="isInFirstPage"
          aria-label="Go to first page">
          <i class="fa fa-angle-double-left"></i>
        </button>
      </li>

      <li class="pagination-item">
        <button
          type="button"
          @click="onClickPreviousPage"
          :disabled="isInFirstPage"
          aria-label="Go to previous page">
          <i class="fa fa-angle-left"></i>
        </button>
      </li>

      <li v-for="page in pages" class="pagination-item">
        <button
          type="button"
          class="page-number"
          @click="onClickPage(page.name)"
          :disabled="page.isDisabled"
          :class="{ active: isPageActive(page.name) }"
          :aria-label="`Go to page number ${page.name}`">
          {{ page.name }}
        </button>
      </li>

      <li class="pagination-item">
        <button
          type="button"
          @click="onClickNextPage"
          :disabled="isInLastPage"
          aria-label="Go to next page">
          <i class="fa fa-angle-right"></i>
        </button>
      </li>

      <li class="pagination-item">
        <button
          type="button"
          @click="onClickLastPage"
          :disabled="isInLastPage"
          aria-label="Go to last page">
          <i class="fa fa-angle-double-right"></i>
        </button>
      </li>

      <li class="pagination-item" v-if="limitOptions">
        <label>
          <select @change="onChangeLimit($event)">
            <option v-for="limitOption in limitOptions" v-bind:value="limitOption">
              {{limitOption}}
            </option>
          </select>
        </label>
      </li>
    </ul>
  </div>
</template>

<script>
    export default {
        name: 'paginate',
        props: {
            maxVisibleButtons: {
                type: Number,
                required: false,
                default: 3
            },
            limitOptions: {
                type: Array,
                required: false
            },
            totalPages: {
                type: Number,
                required: true
            },
            total: {
                type: Number,
                required: true
            },
            perPage: {
                type: Number,
                required: true
            },
            currentPage: {
                type: Number,
                required: true
            },
        },
        computed: {
            startPage() {
                if (this.currentPage === 1) {
                    return 1;
                }
                if (this.currentPage === this.totalPages) {
                    return this.totalPages - this.maxVisibleButtons + 1;
                }
                return this.currentPage - 1;
            },
            endPage() {
                return Math.min(this.startPage + this.maxVisibleButtons - 1, this.totalPages);
            },
            pages() {
                const range = [];
                for (let i = this.startPage; i <= this.endPage; i += 1) {
                    if (i !== 0) {
                        range.push({
                            name: i,
                            isDisabled: i === this.currentPage
                        });
                    }
                }
                return range;
            },
            isInFirstPage() {
                return this.currentPage === 1;
            },
            isInLastPage() {
                return this.currentPage === this.totalPages;
            },
            pagingInfo() {
                return `Đang hiển thị trang ${this.currentPage}/${this.totalPages}
                với ${this.perPage} bản ghi mỗi trang, tổng số có ${this.totalPages} trang ${this.total} bản ghi`;
            }
        },
        methods: {
            onClickFirstPage() {
                this.$emit('pageChanged', 1);
            },
            onClickPreviousPage() {
                this.$emit('pageChanged', this.currentPage - 1);
            },
            onClickPage(page) {
                this.$emit('pageChanged', page);
            },
            onClickNextPage() {
                this.$emit('pageChanged', this.currentPage + 1);
            },
            onClickLastPage() {
                this.$emit('pageChanged', this.totalPages);
            },
            onChangeLimit(event) {
                this.$emit('limitChanged', parseInt(event.target.value));
            },
            isPageActive(page) {
                return this.currentPage === page;
            },
        }
    }
</script>

<style scoped>
  .pagination {
    list-style-type: none;
  }

  .pagination ul {
    margin-bottom: 0;
  }

  .pagination-item {
    display: inline-block;
  }

  .page-number {
    background-color: white !important;
    font-weight: bold;
    color: #555 !important;
  }

  .page-number.active {
    color: white !important;
  }

  .pagination-item button {
    color: white;
    background-color: #254b6d;
    border: 1px solid #c2cfd6;
    border-right: none;
    min-width: 30px;
    min-height: 30px;
  }

  .pagination-item select {
    border: 1px solid #c2cfd6;
    min-width: 30px;
    min-height: 30px;
  }

  .pagination-item select:focus {
    outline: none;
  }

  .active {
    background-color: #9c0200 !important;
  }

  button:disabled,
  button[disabled] {
    color: #9a9a9a;
  }

  .paging-info {
    font-size: 11px;
    color: #7f90a3;
    font-style: italic;
  }

  ul {
    margin-bottom: 0;
  }
</style>
