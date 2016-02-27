import { combineReducers } from 'redux';
import security from './security.js';
import sangha from './sangha.js';
import admins from './admins';
import notifications from './notifications';
import retreats from './retreats';
import routes from './routes';

const rootReducer = combineReducers({
    security,
    sangha,
    admins,
    notifications,
    retreats,
    routes
});

export default rootReducer;