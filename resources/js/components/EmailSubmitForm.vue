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
                        <label for="email">Email</label>
                        <div class="col-md-6">
                            <input id='email' type="email" v-model="email">
                        </div>
                        <input type="submit">

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
                email: ' ',
                message: null

            }
        },
        methods: {
            async onSubmit() {
                console.log(JSON.stringify({email: this.email}));
                if (this.validEmail(this.email)) {
                    const result = await fetch(`api/sendForm`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({email: this.email})
                    });
                    let data = await result.json();
                    this.message = data.message;


                }

            },
            validEmail(email) {
                var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            }
        }

    }
</script>

<style scoped>

</style>
