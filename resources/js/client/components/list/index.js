/**
 * External Dependencies
 */
import React from "react";
import { List, ThemeIcon } from "@mantine/core";
import { IssueClosedIcon, IssueDraftIcon } from "@primer/octicons-react";

const ListComponent = ({ data }) => {
    return (
        <List
            spacing="xs"
            size="sm"
            center
            icon={
                <ThemeIcon color="teal" size={24} radius="xl">
                    <IssueClosedIcon size={12} />
                </ThemeIcon>
            }
        >
            {data != undefined &&
                data.map((item, index) => (
                    <List.Item key={index}>{item.title}</List.Item>
                ))}
        </List>
    );
};

export default ListComponent;
