<template>
	<div>
		<div class="post" v-for="post in posts">
            <div class="post-title">{{ post.title }}</div>
            <div class="post-body">{{ post.body }}</div>
        </div>
	</div>
</template>

<script>
	
	import axios from 'axios';

	export default {

		created() {
			this.getPosts()
		},
		data() {
			return {
				posts: []
			}
		},
		methods: {

			getPosts: function () {

				axios.get('/posts').then(response => {
					this.posts = response.data.posts;
				});

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