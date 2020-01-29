declare module 'vue-eventbus' {
  import { PluginFunction } from 'vue';

  const install: PluginFunction<{}>;

  export { install as default };

  interface EventHub {
    $on(event: string, callback: any): void;
    $off(event: string): void;
    $emit(event: string, attr?: any): void;
  }

  module 'vue/types/vue' {
    interface Vue {
      $eventHub: EventHub;
    }
  }
}
