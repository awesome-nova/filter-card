Nova.booting((Vue) => {
  Vue.component("AwesomeNovaFilterCard", require("./components/Card").default);
  Nova.inertia("AwesomeNovaFilterCard", require("./components/Card").default);
});
