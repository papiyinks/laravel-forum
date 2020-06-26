<template>
    <div>
        <div v-if="signedIn">
            <div class="pt-4">
                <div class="form-group">
                    <textarea name="body"
                        id="body"
                        class="form-control"
                        rows="5"
                        placeholder="Have Something to say?"
                        required
                        v-model="body">
                    </textarea>
                </div>

                <button type="submit"
                    class="btn btn-success"
                    @click="addReply">Post</button>
            </div>
        </div>

        <p class="text-center pt-3" v-else>
            Please <a href="/login">sign in</a> to participate in this discussion.
        </p>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                body: '',
            }
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            }
        },

        methods: {
            addReply() {
                axios.post(location.pathname + '/replies', {body: this.body })
                    .then(({data}) => {
                        this.body = '';

                        flash('Your reply has been posted');

                        this.$emit('created', data)
                    })
            }
        }
    }
</script>
