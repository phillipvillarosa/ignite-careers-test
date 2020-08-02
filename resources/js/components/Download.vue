<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-4">

                    <div class="card-body">
                        <caption>
                            <button class="btn btn-success" @click.prevent="download">Download CSV</button>
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
                let csvContent = "data:text/csv;charset=utf-8,";
                csvContent += [
                Object.keys(this.parsed_result).join(";"),
                ...this.parsed_result.map(item => Object.values(item).join(";"))
                ]
                .join("\n")
                .replace(/(^\[)|(\]$)/gm, "");

                const data = encodeURI(csvContent);
                const link = document.createElement("a");
                link.setAttribute("href", data);
                link.setAttribute("download", "export.csv");
                link.click();
            }
        }
    }
</script>
