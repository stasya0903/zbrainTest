<template>
    <div class="col-8 mt-5">
        <div class="card">
            <div class="card-header">
                Введите email
            </div>
            <div class="alert alert-warning alert-dismissible fade show"
                 role="alert"
                 v-show="message">
                {{message}}
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-label="Close"
                        @click="message=null">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="card-body">
                <form v-on:submit.prevent="onSubmit">
                    <div class="form-group row">
                        <label for="email"
                               class="col-md-4 col-form-label text-md-center">Email</label>
                        <div class="col-4">
                            <input id='email' type="text" v-model="email"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4 mt-2">
                            <input type="submit" class="btn btn-outline-secondary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: '',
                message: null

            }
        },
        methods: {
            async onSubmit() {
                if (this.validEmail(this.email)) {
                    axios.post(`api/sendForm`, {email: this.email})
                        .then((res) => {
                            let data = res.data;
                            this.message = data.message

                        })
                        .catch((err) => {
                            this.message =  err.message
                        })

                } else {
                    this.message = "введен невалидный email"
                }

            },
            validEmail(email) {
                let reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/;
                return reg.test(email);
            }
        }

    }
</script>

<style scoped>

</style>
