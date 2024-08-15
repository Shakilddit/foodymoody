<template>
	<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Author List</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary">
                                        <router-link to="/add-author" class="text-white">Add New Author</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Image</th>
                                            <th>Author Name</th>
                                            <th>Slug</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="getAllAuthor.length != 0">
                                        <tr v-for="(author,index) in getAllAuthor" :key="author.id">
                                            <td>{{index+1}}</td>
                                            <td><img :src="ourImage(author.image)" class="img-fluid" height="60" width="60"></td>
                                            <td>{{author.name}}</td>
                                            <td>{{author.slug}}</td>
                                            <td>{{author.created_at | timeformat}}</td>
                                            <td>
                                                <router-link :to="`/edit-author/${author.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="#" @click.prevent = "deleteAuthor(author.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="6" class="text-center"><i class="far fa-folder-open"></i> No Data has been Found</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="pagination">
                                    <button class="btn btn-sm btn-primary" @click.prevent="prevPage()">
                                        Previous
                                    </button>
                                    <span class="ml-2 mr-2">Page {{this.pageNumber}} of {{this.last_page}}</span>
                                    <button class="btn btn-sm btn-primary" @click.prevent="nextPage()">
                                        Next
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	</div>
</template>

<script>
    export default {
        name:"List",
        data(){
            return{
                current_page: '',
                last_page: '',
                pageNumber:1,
                url:"/get/author/backend?page="+this.pageNumber,
            }
        },
        mounted(){
            this.$store.dispatch("allAuthor",this.url),
            axios.get(this.url)
                .then((response) => {
                    this.current_page=response.data.authors.current_page
                    this.last_page=response.data.authors.last_page
                })
        },
        computed:{
            getAllAuthor(){
                return this.$store.getters.getAuthor
            }
        },
        methods:{
            ourImage(img){
                return "author_images/"+img;
            },
            deleteAuthor(id){
                axios.get('/delete/author/'+id)
                    .then(()=>{
                       this.$store.dispatch("allAuthor",this.url)
                        toast.fire({
                            icon: 'success',
                            title: 'Author Deleted successfully'
                        })
                    })
                    .catch(()=>{
                        toast.fire({
                            icon: 'error',
                            text: ' Author has Product',
                        })
                    })
            },
            nextPage(){
                if(this.pageNumber < this.last_page){
                    this.pageNumber = this.pageNumber+1
                }
                this.url = "/get/author/backend?page="+this.pageNumber,
                this.$store.dispatch("allAuthor",this.url)
            },
            prevPage(){
                if(this.pageNumber > 1){
                    this.pageNumber = this.pageNumber-1
                }
                this.url = "/get/author/backend?page="+this.pageNumber,
                this.$store.dispatch("allAuthor",this.url)
            },
        }
    }
</script>

<style lang="sass" scoped>

</style>
