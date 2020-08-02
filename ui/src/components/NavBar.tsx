import * as React from 'react';
import { Nav, INavStyles, INavLinkGroup } from 'office-ui-fabric-react/lib/Nav';

const navStyles: Partial<INavStyles> = { root: { width: 300 } };

const navLinkGroups: INavLinkGroup[] = [
    {
        name: '基本功能',
        expandAriaLabel: 'Expand Basic components section',
        collapseAriaLabel: 'Collapse Basic components section',
        links: [
            {
                key: 'ActivityItem',
                name: 'ActivityItem',
                url: '#/examples/activityitem',
            },
            {
                key: 'Breadcrumb',
                name: 'Breadcrumb',
                url: '#/examples/breadcrumb',
            },
            {
                key: 'Button',
                name: 'Button',
                url: '#/examples/button',
            },
        ],
    },
    {
        name: '扩展功能',
        expandAriaLabel: 'Expand Extended components section',
        collapseAriaLabel: 'Collapse Extended components section',
        links: [
            {
                key: 'ColorPicker',
                name: 'ColorPicker',
                url: '#/examples/colorpicker',
            },
            {
                key: 'ExtendedPeoplePicker',
                name: 'ExtendedPeoplePicker',
                url: '#/examples/extendedpeoplepicker',
            },
            {
                key: 'GroupedList',
                name: 'GroupedList',
                url: '#/examples/groupedlist',
            },
        ],
    },
    {
        name: '通用',
        expandAriaLabel: 'Expand Utilities section',
        collapseAriaLabel: 'Collapse Utilities section',
        links: [
            {
                key: 'FocusTrapZone',
                name: 'FocusTrapZone',
                url: '#/examples/focustrapzone',
            },
            {
                key: 'FocusZone',
                name: 'FocusZone',
                url: '#/examples/focuszone',
            },
            {
                key: 'MarqueeSelection',
                name: 'MarqueeSelection',
                url: '#/examples/marqueeselection',
            },
        ],
    },
];

export const NavBar: React.FunctionComponent = () => {
    return (
        <Nav styles={navStyles} ariaLabel="Nav example similiar to one found in this demo page" groups={navLinkGroups} />
    );
};
