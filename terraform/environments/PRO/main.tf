module "s3" {
  source = "../../modules/S3"

  bucket_name   = var.s3_bucket_name
  create_bucket = var.create_s3_bucket

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

module "iam" {
  count = var.enable_codepipeline ? 1 : 0

  source = "../../modules/IAM"

  codepipeline_role_name       = var.codepipeline_role_name
  codedeploy_service_role_name = var.codedeploy_service_role_name
  artifact_bucket_arn          = module.s3.bucket_arn

  tags = {
    Environment = "PRO"
    ManagedBy   = "Terraform"
  }
}

module "codedeploy" {
  count = var.enable_codepipeline ? 1 : 0

  source = "../../modules/CodeDeploy"

  application_name        = var.codedeploy_application_name
  deployment_group_name   = var.codedeploy_deployment_group_name
  service_role_arn        = module.iam[0].codedeploy_service_role_arn
  deployment_config_name  = var.codedeploy_deployment_config_name
  tag_key                 = var.codedeploy_target_tag_key
  tag_value               = var.codedeploy_target_tag_value
  tag_type                = var.codedeploy_target_tag_type

  tags = {
    Environment = "PRO"
    ManagedBy   = "Terraform"
  }
}

module "ec2" {
  count = var.enable_ec2 ? 1 : 0

  source = "../../modules/EC2"

  instance_name                = var.ec2_instance_name
  ami_id                       = var.ec2_ami_id
  instance_type                = var.ec2_instance_type
  subnet_id                    = var.ec2_subnet_id
  vpc_security_group_ids       = var.ec2_vpc_security_group_ids
  associate_public_ip_address  = var.ec2_associate_public_ip_address
  key_name                     = var.ec2_key_name
  iam_instance_profile         = var.ec2_iam_instance_profile
  user_data                    = var.ec2_user_data
  root_volume_size             = var.ec2_root_volume_size
  root_volume_type             = var.ec2_root_volume_type

  tags = merge(
    {
      Environment = "PRO"
      ManagedBy   = "Terraform"
    },
    {
      (var.codedeploy_target_tag_key) = var.codedeploy_target_tag_value
    }
  )
}

module "codepipeline" {
  count = var.enable_codepipeline ? 1 : 0

  source = "../../modules/CodePipeline"

  pipeline_name                    = var.codepipeline_name
  pipeline_role_arn                = module.iam[0].codepipeline_role_arn
  artifact_bucket                  = module.s3.bucket_name
  source_bucket                    = module.s3.bucket_name
  source_object_key                = var.codepipeline_source_object_key
  poll_for_source_changes          = var.codepipeline_poll_for_source_changes
  codedeploy_application_name      = module.codedeploy[0].application_name
  codedeploy_deployment_group_name = module.codedeploy[0].deployment_group_name

  tags = {
    Environment = "PRO"
    ManagedBy   = "Terraform"
  }
}
