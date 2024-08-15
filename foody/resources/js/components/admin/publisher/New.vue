<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Add New Publisher</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="publisherImage">Publisher Image (120*120)</label>
                                        <input @change="changePhoto($event)" type="file" accept=".png, .jpg, .jpeg ,.svg, .JPG, .PNG" class="form-control" id="publisherImage" name="image" :class="{ 'is-invalid': form.errors.has('image') }">
                                        <has-error :form="form" field="image"></has-error>
                                        <img :src="form.image" class="img-fluid mt-1">
                                    </div>
                                    <div class="form-group">
                                        <label for="publisherID">New Publisher Name</label>
                                        <input type="text" class="form-control" id="publisherID" placeholder="Enter Publisher Name" v-model="form.publisher_name" name="publisher_name" :class="{ 'is-invalid': form.errors.has('publisher_name') }">
                                        <has-error :form="form" field="publisher_name"></has-error>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" @click.prevent="addPublisher()">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name : "New",
    data () {
        return {
            form: new Form({
                publisher_name: '',
                image: ''
            })
        }
    },
    methods: {
        changePhoto(event){
            let file = event.target.files[0];
            if(file.size>1048576){
                swal.fire({
                    icon: 'error',
                    title: 'Oppss...',
                    text: 'Image Size is Greater than 1MB',
                })
            }
            else{
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.image = event.target.result
                };
                reader.readAsDataURL(file);
            }
        },
        addPublisher () {
            this.form.post('/add/new/publisher')
            .then(({ response }) => {
                this.$router.push('/publisher-list');

                toast.fire({
                    icon: 'success',
                    title: 'Publisher Added successfully'
                })

            })
            .catch(()=>{
                console.log('Error cateched')
            })
        }
    }
}
</script>

<style lang="sass" scoped>

</style>
