import React, {Component} from 'react';

import Event from './Event';

export default class Events extends Component {
  render() {
    return (
      <div role="tabpanel" className="tab-pane" id='evenementen'>
        Events
        <Event />
      </div>
    )
  }
}
