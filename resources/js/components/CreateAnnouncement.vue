<script>

    export default {

        data() {
            return {
                distance: 0,
                time: 0
            }
        },

        computed: {

            cost() {
                return (this.distance * this.time / 280).toFixed(2);
            }

        }

    }

</script>
