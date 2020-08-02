import React from 'react';
import {AnimationClassNames, mergeStyles, getTheme} from 'office-ui-fabric-react/lib/Styling';

export const HeaderBar: React.FunctionComponent = () => {
    return (
        <div className={contentClass}> JXH-BOT </div>
    );
};
const theme = getTheme();
const contentClass = mergeStyles([
    {
        backgroundColor: 'rgba(0,120,212,0.7)',
        color: theme.palette.white,
        lineHeight: '50px',
        padding: '0 20px',
        top: 0,
        position: "fixed",
        width: '100%',
        backdropFilter: 'blur(10px)',
        zIndex:100
    },
    AnimationClassNames.scaleUpIn100,
]);