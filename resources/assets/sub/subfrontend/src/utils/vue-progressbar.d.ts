declare module 'vue-progressbar' {
  import { PluginFunction } from 'vue';

  const install: PluginFunction<{}>;

  export { install as default };

  interface ProgressMethods {
    start(): void;
    finish(): void;
    fail(): void;
    set(val: number): void;
    get(): number;
    setColor(color: string): void;
  }

  module 'vue/types/vue' {
    interface Vue {
      $Progress: ProgressMethods;
    }
  }
}
