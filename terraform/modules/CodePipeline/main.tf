resource "aws_codepipeline" "this" {
  name     = var.pipeline_name
  role_arn = var.pipeline_role_arn

  artifact_store {
    location = var.artifact_bucket
    type     = "S3"
  }

  stage {
    name = "Source"

    action {
      name             = "SourceFromS3"
      category         = "Source"
      owner            = "AWS"
      provider         = "S3"
      version          = "1"
      output_artifacts = ["source_output"]

      configuration = {
        S3Bucket             = var.source_bucket
        S3ObjectKey          = var.source_object_key
        PollForSourceChanges = tostring(var.poll_for_source_changes)
      }
    }
  }

  stage {
    name = "Deploy"

    action {
      name            = "DeployToCodeDeploy"
      category        = "Deploy"
      owner           = "AWS"
      provider        = "CodeDeploy"
      input_artifacts = ["source_output"]
      version         = "1"

      configuration = {
        ApplicationName     = var.codedeploy_application_name
        DeploymentGroupName = var.codedeploy_deployment_group_name
      }
    }
  }

  tags = merge(
    {
      Name = var.pipeline_name
    },
    var.tags
  )
}
