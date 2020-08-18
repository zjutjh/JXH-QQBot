import * as React from 'react';
import { Nav, INavStyles, INavLinkGroup } from 'office-ui-fabric-react/lib/Nav';

const navStyles: Partial<INavStyles> = { root: { width: 375,flexWrap:"wrap" } };

const navLinkGroups: INavLinkGroup[] = [
    {
        name: '基本功能',
        expandAriaLabel: 'Expand Basic components section',
        collapseAriaLabel: 'Collapse Basic components section',
        links: [
            {
                key: 'ActivityItem',
                name: '词典',
                url: '#/dictionary',
            },

        ],
    },
    {
        name: '扩展功能',
        expandAriaLabel: 'Expand Extended components section',
        collapseAriaLabel: 'Collapse Extended components section',
        links: [

        ],
    },
    {
        name: '通用',
        expandAriaLabel: 'Expand Utilities section',
        collapseAriaLabel: 'Collapse Utilities section',
        links: [

        ],
    },
];

export const NavBar: React.FunctionComponent = () => {
    return (
        <Nav styles={navStyles} ariaLabel="Nav example similiar to one found in this demo page" groups={navLinkGroups} />
    );
};
