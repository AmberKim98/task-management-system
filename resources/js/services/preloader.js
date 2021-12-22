export default {
    name: 'Preloader',
    props: {
      color: {
        type: String,
        default: '#41b883',
      },
      scale: {
        type: Number,
        default: 1,
      },
    },
    computed: {
      cssVars() {
        return {
          '--color': '#6699ff',
          '--scale': this.scale,
        }
      }
    }
  }