<template>
    <p>{{ link_redirect }}</p>
</template>
<script>
export default {
    data() {
        return {
            link_redirect: "",
        };
    },
    async mounted() {
        console.log(window.location.href);
        var url = window.location.href;
        // Find the last occurrence of "/"
        var lastSlashIndex = url.lastIndexOf("/");

        // Extract the string after the last "/"
        var result = url.substring(lastSlashIndex + 1);
        let urlRedirect = "http://127.0.0.1:8000/api/redirect/" + result;
        await axios
            .post(urlRedirect)
            .then((resp) => {
                console.log("resp", resp.data.data);
                window.open(resp.data.data);
            })
            .catch((err) => {
                alert(err);
            });
        window.close();
    },
};
</script>
