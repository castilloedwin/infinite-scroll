<template>
	<div>
		<div class="post" v-for="post, index in posts">
            <div class="post-title">{{ index + 1 }} {{ post.title }}</div>
            <div class="post-body">{{ post.body }}</div>
        </div>
        <infinite-loading @infinite="infiniteHandler">
        	<span slot="no-more">
        		No hay más datos que cargar :(
        	</span>
        </infinite-loading>
	</div>
</template>

<script>
	
	import axios from 'axios';
	import InfiniteLoading from 'vue-infinite-loading';

	export default {

		created() {
			this.getPosts();
		},
		data() {
			return {
				posts: []
			}
		},
		methods: {

			getPosts: function () {

				axios.get('/posts').then(response => {
					this.posts = response.data.data;
				});

			},
			infiniteHandler: function ($state) {
				let limit = this.posts.length / 40 + 1;
				axios.get('/posts', { params: { page: limit } }).then(response => {
					this.loadMore($state, response);
				});
			},
			loadMore: function ($state, response) {
				if ( response.data.data.length ) {
					this.posts = this.posts.concat(response.data.data);
					setTimeout(() => {
						$state.loaded();
					}, 3000);

					if ( response.data.total == this.posts.length ) {
						$state.complete();
					}
				} else {
					$state.complete();
				}
			}

		}

	}

</script>

<style lang="scss" scoped>
	.post {
		margin-bottom: 20px;
		padding-bottom: 20px;
		border-bottom: solid 1px #CCC;

		.post-title {
			font-size: 2em;
		}

		.post-body {
			font-size: 1.4em;
		}

	}
</style>