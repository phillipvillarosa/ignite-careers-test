<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-4">

                    <div class="card-body">
                        <caption>
                            <button class="btn btn-success" @click.prevent="download">Download</button>
                        </caption>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Email</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Mobile</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="data in parsed_result.data">
                                    <td>{{data.uid}}</td>
                                    <td>{{data.email}}</td>
                                    <td>{{data.first_name}}</td>
                                    <td>{{data.last_name}}</td>
                                    <td>{{data.mobile}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['result'],

        data() {
            return {
                parsed_result: JSON.parse(this.result)
            }
        },

        methods: {
            download() {
                axios.get('/download-csv', {
                    params: {
                        download: true
                    }
                }).then(({data}) => {
                    const url = window.URL.createObjectURL(new Blob([data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'users.csv');
                    document.body.appendChild(link);
                    link.click()
                });
            }
        }
    }
</script>
