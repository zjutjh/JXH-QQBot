import React from 'react';
import ReactDOM from 'react-dom';
import {mergeStyles} from 'office-ui-fabric-react';
import Router from './routers'
// Inject some global styles
mergeStyles({
    selectors: {
        ':global(body), :global(html), :global(#app)': {
            margin: 0,
            padding: 0,
            height: '100vh'
        }
    }
});

ReactDOM.render((<Router/>), document.getElementById('app'));
