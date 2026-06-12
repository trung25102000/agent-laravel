module "s3" {
  source = "../../modules/S3"

  bucket_name = var.s3_bucket_name

  tags = {
    Environment = "PRO"
    ManagedBy   = "Terraform"
  }
}

resource "local_file" "s3_info" {
  filename = "${path.root}/../../../s3/info.txt"
  content  = <<-EOT
    AWS_ACCESS_KEY_ID=
    AWS_SECRET_ACCESS_KEY=
    AWS_REGION=${var.aws_region}
    S3_BUCKET=${module.s3.bucket_name}
  EOT
}

module "codepipeline" {
  count = var.enable_codepipeline ? 1 : 0

  source = "../../modules/CodePipeline"

  pipeline_name                    = var.codepipeline_name
  pipeline_role_arn                = var.codepipeline_role_arn
  artifact_bucket                  = module.s3.bucket_name
  source_bucket                    = module.s3.bucket_name
  source_object_key                = var.codepipeline_source_object_key
  poll_for_source_changes          = var.codepipeline_poll_for_source_changes
  codedeploy_application_name      = var.codedeploy_application_name
  codedeploy_deployment_group_name = var.codedeploy_deployment_group_name

  tags = {
    Environment = "PRO"
    ManagedBy   = "Terraform"
  }
}
