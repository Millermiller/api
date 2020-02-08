import { Actions } from 'vuex-smart-module';
import MenuState from '@/store/modules/menu/state';
import UserGetters from '@/store/modules/menu/getters';
import UserMutations from '@/store/modules/menu/mutations';

export default class UserActions extends Actions<MenuState, UserGetters, UserMutations, UserActions> {

}
