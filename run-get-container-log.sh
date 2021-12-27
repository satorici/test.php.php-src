#!/bin/bash
LOG_GROUP_NAME="/ecs/ContainerTask03"
LOG_STREAM_NAME="`aws logs describe-log-streams --log-group-name "${LOG_GROUP_NAME}"| jq -r '.logStreams | sort_by(.creationTime) | .[-1].logStreamName'`"
aws logs get-log-events --log-group-name "${LOG_GROUP_NAME}" --log-stream-name "${LOG_STREAM_NAME}" | jq -r '.events[] | select(has("message")) | .message'
